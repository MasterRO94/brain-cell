<?php

namespace Brain\Cell\Transformer;

use Brain;
use Brain\Cell\AbstractTransformer;
use Brain\Cell\Exception\RuntimeException;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;
use Doctrine\Common\Inflector\Inflector;

/**
 * An encoder for transforming {@link TransferEntityInterface} to arrays.
 */
class ArrayEncoder extends AbstractTransformer
{

    /**
     * Encode the given {@link TransferEntityInterface} and return the serialised view.
     *
     * @param TransferEntityInterface $entity
     * @return array
     */
    public function encode(TransferEntityInterface $entity)
    {

        //  If we are encoding a collection of resources..
        if ($entity instanceof ResourceCollection) {
            return $this->encodeCollection($entity);
        }

        //  If we are encoding a resource..
        if ($entity instanceof AbstractResource) {
            return $this->encodeResource($entity);
        }

        //  The encoder may not support encoding all transfer entities.
        throw new RuntimeException(sprintf('Unexpected TransferEntityInterface "%s"', get_class($entity)));

    }

    /**
     * Serialise a {@link AbstractResource}.
     *
     * @param AbstractResource $resource
     * @return array
     */
    protected function encodeResource(AbstractResource $resource)
    {
        $data = [];

        //  Serialisation is done on the properties of the transfer objects.
        //  For this we need to make use of reflection to get the protected properties.
        $class = new \ReflectionClass(get_class($resource));
        $properties = $class->getProperties(\ReflectionProperty::IS_PROTECTED);

        //  Return any associations that we should be validating.
        //  Note also that these look "deprecated" but are actually "internal".
        $resources = $resource->getAssociatedResources();
        $collections = $resource->getAssociatedCollections();
        $originalData = $resource->getData();

        foreach ($properties as $property) {

            //  As properties are protected we mark them as public and get their value using reflection.
            $property->setAccessible(true);
            $value = $property->getValue($resource);
            $snakeCasePropertyName = Inflector::tableize($property->getName());

            //  All properties prefixed with "brain" are to be ignored.
            //  There is a reason why we cannot make use of special characters as I intended to do, cant remember.
            if (substr($property->getName(), 0, 5) === 'brain') {
                continue;
            }

//            if ($value === null) {
//                // Don't include missing values
//                continue;
//            }
//
//            if ($originalData !== null && $property->getName() != 'data') {
//                if ($originalData[$snakeCasePropertyName] == $value) {
//                    continue;
//                }
//            }

            if ($value instanceof TransferEntityInterface) {

                //  Simply if the property value is marked as a resource or collection then serialise it.
                if (
                    isset($resources[$property->getName()])
                    || isset($collections[$property->getName()])
                ) {
                    $value = $this->encode($value);
                } else {
                    throw new RuntimeException(sprintf(
                        'Did not expect TransferEntityInterface in "%s" of "%s"',
                        $property->getName(),
                        get_class($resource)
                    ));
                }

            //  In this case if the property is marked as a collection but isn't we replace it.
            } elseif (
                isset($collections[$property->getName()])
                && (!$value instanceof ResourceCollection)
            ) {
                $value = $this->encodeCollection(new ResourceCollection);
            }

            $data[$snakeCasePropertyName] = $value;
        }

        return $data;

    }

    /**
     * Serialise a {@link ResourceCollection}.
     *
     * @param ResourceCollection $collection
     * @return array
     */
    protected function encodeCollection(ResourceCollection $collection)
    {
        $resources = [];

        //  Loop over all the resources in the collection and serialise them.
        foreach ($collection as $resource) {
            $resources[] = $this->encodeResource($resource);
        }

        return $resources;
    }

}
