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
use Doctrine\Common\Inflector\Inflector;

/**
 * A decoder for hydrating {@link TransferEntityInterface}'s from arrays.
 */
class ArrayDecoder extends AbstractTransformer
{
    /**
     * Decode the given $data and populate the given {@link TransferEntityInterface}.
     *
     * @param TransferEntityInterface $entity
     * @param array $data
     * @return TransferEntityInterface
     */
    public function decode(TransferEntityInterface $entity, array $data)
    {

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
            $camelCasePropertyName = Inflector::camelize($propertyName);

            //  We throw if the property is not available against the object and is not a meta property.
            if (!$class->hasProperty($camelCasePropertyName)) {
                throw new RuntimeException(sprintf(
                    'Additional property "%s" was not expected for "%s"',
                    $propertyName,
                    get_class($resource)
                ));
            }

            $property = $class->getProperty($camelCasePropertyName);

            //  Decode resources.
            if (isset($resources[$property->getName()])) {
                $child = new $resources[$property->getName()];
                $value = $this->decodeResource($child, $value);

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
            unset($properties[$camelCasePropertyName]);

        }

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
        foreach ($data as $resource) {
            $entity = $collection->getEntityClassOrThrow();
            $entity = new $entity;

            $entity = $this->decodeResource($entity, $resource);
            $collection->add($entity);

        }

        return $collection;
    }
}
