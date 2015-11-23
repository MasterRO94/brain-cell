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
class ArrayDecoder extends AbstractTransformer
{

    /**
     * All the meta properties that should be ignored from decoding.
     *
     * @var string[]
     */
    protected $metaProperties = [
        '$links'
    ];

    /**
     * Decode the given $data and populate the given {@link TransferEntityInterface}.
     *
     * @param TransferEntityInterface $entity
     * @param array $data
     * @return TransferEntityInterface
     */
    public function decode(TransferEntityInterface $entity, array $data)
    {

        //  If the given $data is not an array we can throw.
        if (!is_array($data)) {
            throw new RuntimeException('The given $data must be an array');
        }

        //  If we are decoding a collection of resources..
        if ($entity instanceof ResourceCollection) {
            return $this->decodeCollection($entity, $data);
        }

        //  If we are decoding a resource..
        if ($entity instanceof AbstractResource) {
            return $this->decodeResource($entity, $data);
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
    protected function decodeResource(AbstractResource $resource, array $data)
    {

        //  Serialisation is done on the properties of the transfer objects.
        //  For this we need to make use of reflection to get the protected properties.
        $class = new \ReflectionClass(get_class($resource));

        //  Return any associations that we should be validating.
        //  Note also that these look "deprecated" but are actually "internal".
        $resources = $resource->getAssociatedResources();
        $collections = $resource->getAssociatedCollections();

        //  A collection of properties against the object that we populated.
        //  Used later to validate missing properties.
        $properties = [];
        foreach ($class->getProperties() as $property) {

            //  All properties prefixed with "brain" are to be ignored.
            //  There is a reason why we cannot make use of special characters as I intended to do, cant remember.
            if (substr($property->getName(), 0, 5) === 'brain') {
                continue;
            }

            $properties[$property->getName()] = $property;

        }

        foreach ($data as $propertyName => $value) {

            //  We throw if the property is not available against the object and is not a meta property.
            if (!$class->hasProperty($propertyName) && !in_array($propertyName, $this->metaProperties)) {
                throw new RuntimeException(sprintf(
                    'Additional property "%s" was not expected for "%s"',
                    $propertyName,
                    get_class($resource)
                ));

            //  If it is meta property then we can skip it, its going to get handled later.
            } elseif (in_array($propertyName, $this->metaProperties)) {
                continue;
            }

            $property = $class->getProperty($propertyName);

            //  Decode resources.
            if (isset($resources[$property->getName()])) {
                $class = new $resources[$property->getName()];
                $value = $this->decodeResource($class, $value);

            //  Decode collections.
            } elseif (isset($collections[$property->getName()])) {
                $collection = new ResourceCollection;
                $collection->setEntityClass($collections[$property->getName()]);
                $value = $this->decodeCollection($collection, $value);
            }

            //  Using reflection set the protected property.
            $property->setAccessible(true);
            $property->setValue($resource, $value);

            //  Remove each property so we can see whats left.
            unset($properties[$propertyName]);

        }

        //  Validate that all properties were set in the object.
        if (count($properties) > 0) {

            /** @var \ReflectionProperty $property */
            $property = array_shift($properties);

            throw new RuntimeException(sprintf(
                'Missing property "%s" was expected for "%s"',
                $property->getName(),
                get_class($resource)
            ));

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
    protected function decodeCollection(ResourceCollection $collection, array $data)
    {

        if (!isset($data['data'])) {
            throw new RuntimeException('The ResourceCollection $data is not formatted correctly');
        }

        foreach ($data['data'] as $resource) {
            $entity = $collection->getEntityClass();
            $entity = new $entity;

            $entity = $this->decodeResource($entity, $resource);
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
