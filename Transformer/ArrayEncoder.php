<?php

namespace Brain\Cell\Transformer;

use Brain;
use Brain\Cell\Exception\RuntimeException;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;

/**
 * An encoder for transforming {@link TransferEntityInterface} to arrays.
 */
class ArrayEncoder implements
    Brain\Cell\TransformerEncoderInterface
{

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function encode(TransferEntityInterface $entity)
    {

        //  If we are encoding a collection of resources..
        if ($entity instanceof ResourceCollection) {
            return $this->collection($entity);
        }

        //  If we are encoding a resource..
        if ($entity instanceof AbstractResource) {
            return $this->resource($entity);
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
    protected function resource(AbstractResource $resource)
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

        foreach ($properties as $property) {

            //  As properties are protected we mark them as public and get their value using reflection.
            $property->setAccessible(true);
            $value = $property->getValue($resource);

            if ($value instanceof TransferEntityInterface) {

                //  Simply if the property value is marked as a resource or collection then serialise it.
                if (isset($resources[$property->getName()]) || isset($collections[$property->getName()])) {
                    $value = $this->encode($value);
                } else {
                    throw new RuntimeException(sprintf(
                        'Was not expected EntityResource at "%s" of "%s"',
                        $property->getName(),
                        get_class($resource)
                    ));
                }

            //  In this case if the property is marked as a collection but isn't we replace it.
            } elseif (isset($collections[$property->getName()]) && (!$value instanceof ResourceCollection)) {
                $value = $this->collection(new ResourceCollection);
            }

            $data[$property->getName()] = $value;

        }

        return $data;

    }

    /**
     * Serialise a {@link ResourceCollection}.
     *
     * @param ResourceCollection $collection
     * @return array
     */
    protected function collection(ResourceCollection $collection)
    {
        $data = [];

        foreach ($collection as $resource) {
            $data[] = $this->resource($resource);
        }

        //  The format for the collection is place all the data within "data".
        //  This is for later formatting where we can attach things like "links" and "pagination".
        return [
            'data' => $data
        ];

    }

}
