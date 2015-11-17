<?php

namespace Brain\Cell\Transformer;

use Brain;
use Brain\Cell\AbstractTransformer;
use Brain\Cell\Exception\RuntimeException;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\EntityMeta\Link;
use Brain\Cell\Transfer\EntityMeta\MetaContainingInterface;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;

/**
 * A decoder for hydrating {@link TransferEntityInterface}'s from arrays.
 */
class ArrayDecoder extends AbstractTransformer implements
    Brain\Cell\TransformerDecoderInterface
{

    /**
     * {@inheritdoc}
     *
     * @param array $data
     */
    public function decode(TransferEntityInterface $entity, $data)
    {

        //  If the given $data is not an array we can throw.
        if (!is_array($data)) {
            throw new RuntimeException('The given $data must be an array');
        }

        //  If we are decoding a collection of resources..
        if ($entity instanceof ResourceCollection) {
            return $this->collection($entity, $data);
        }

        //  If we are decoding a resource..
        if ($entity instanceof AbstractResource) {
            return $this->resource($entity, $data);
        }

        //  The decoder may not support serialising all transfer entities.
        throw new RuntimeException(sprintf('Unexpected TransferEntityInterface "%s"', get_class($entity)));

    }

    /**
     * Populate a {@link AbstractResource} with the given $data.
     *
     * @param AbstractResource $resource
     * @param array $data
     * @return AbstractResource
     */
    protected function resource(AbstractResource $resource, array $data)
    {

        //  Serialisation is done on the properties of the transfer objects.
        //  For this we need to make use of reflection to get the protected properties.
        $class = new \ReflectionClass(get_class($resource));

        //  Return any associations that we should be validating.
        //  Note also that these look "deprecated" but are actually "internal".
        $resources = $resource->getAssociatedResources();
        $collections = $resource->getAssociatedCollections();

        foreach ($data as $property => $value) {

            //  The encoder will ignore any values within the $data that are not against the object.
            //  At some point we might want to change this out so we are more strict.
            if (!$class->hasProperty($property)) {
                continue;
            }

            $property = $class->getProperty($property);

            //  Decode resources.
            if (isset($resources[$property->getName()])) {
                $class = new $resources[$property->getName()];
                $value = $this->resource($class, $value);
            }

            //  Decode collections.
            if (isset($collections[$property->getName()])) {
                $collection = new ResourceCollection;
                $collection->setEntityClass($collections[$property->getName()]);
                $value = $this->collection($collection, $value);
            }

            //  Using reflection set the protected property.
            $property->setAccessible(true);
            $property->setValue($resource, $value);

        }

        $this->handleMetaLinks($resource, $data);
        return $resource;
    }

    /**
     * Populate a {@link ResourceCollection} with the given $data.
     *
     * @param ResourceCollection $collection
     * @param array $data
     * @return ResourceCollection
     */
    protected function collection(ResourceCollection $collection, array $data)
    {

        if (!isset($data['data'])) {
            throw new RuntimeException('The ResourceCollection $data is not formatted correctly');
        }

        foreach ($data['data'] as $resource) {
            $entity = $collection->getEntityClass();
            $entity = new $entity;

            $entity = $this->resource($entity, $resource);
            $collection->add($entity);

        }

        $this->handleMetaLinks($collection, $data);
        return $collection;

    }

    /**
     * Attach {@link Link}s that are found in the given $data.
     *
     * @param MetaContainingInterface $entity
     * @param array $data
     */
    protected function handleMetaLinks(MetaContainingInterface $entity, array $data)
    {

        //  Check for the links property.
        if (!isset($data['$links'])) {
            return;
        }

        foreach ($data['$links'] as $rel => $href) {
            $this->transferEntityMetaManager->addMetaLink($entity, new Link($rel, $href));
        }

    }

}
