<?php

namespace Brain\Cell\Transformer;

use Brain;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;

class ArrayDecoder implements
    Brain\Cell\TransformerDecoderInterface
{

    /**
     * {@inheritdoc}
     *
     * @param array $data
     */
    public function decode(TransferEntityInterface $entity, $data)
    {
        return $this->deserialise($entity, $data);
    }

    protected function deserialise(TransferEntityInterface $entity, array $data)
    {

        if ($entity instanceof ResourceCollection) {
            $collection = $entity;

            foreach ($data['data'] as $resource) {
                $entity = $collection->getEntityClass();
                $entity = new $entity;

                $entity = $this->deserialise($entity, $resource);
                $collection->add($entity);

            }

            return $collection;

        }


        $class = new \ReflectionClass(get_class($entity));

        $resources = [];
        $collections = [];

        if ($entity instanceof AbstractResource) {
            $resources = $entity->getAssociatedResources() ?: [];
            $collections = $entity->getAssociatedCollections() ?: [];
        }

        foreach ($data as $property => $value) {

            if (!$class->hasProperty($property)) {
                continue;
            }

            $property = $class->getProperty($property);

            if (isset($resources[$property->getName()])) {
                $class = new $resources[$property->getName()];
                $value = $this->deserialise($class, $value);
            }

            if (isset($collections[$property->getName()])) {
                $collection = new ResourceCollection;
                $collection->setEntityClass($collections[$property->getName()]);
                $value = $this->deserialise($collection, $value);
            }

            $property->setAccessible(true);
            $property->setValue($entity, $value);

        }

        return $entity;

    }

}
