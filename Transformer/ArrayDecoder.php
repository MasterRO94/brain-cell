<?php

namespace Brain\Cell\Transformer;

use Brain\Cell\Exception\RuntimeException;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\Collection;
use Brain\Cell\TransferEntityInterface;

use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

class ArrayDecoder
{

    public function decode(TransferEntityInterface $entity, array $data)
    {
        return $this->deserialise($entity, $data);


    }

    protected function deserialise(TransferEntityInterface $entity, array $data)
    {

        if ($entity instanceof Collection) {
            $collection = $entity;

            if (!isset($data['data'])) {
                return $collection;
            }

            foreach ($data['data'] as $resource) {
                $entity = $collection->getEntityClass();
                $entity = new $entity;

                $entity = $this->deserialise($entity, $resource);
                $collection->getData()->add($entity);

            }

            return $collection;

        }


        $class = new ReflectionClass(get_class($entity));

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
                $collection = new Collection($collections[$property->getName()]);
                $value = $this->deserialise($collection, $value);
            }

            $property->setAccessible(true);
            $property->setValue($entity, $value);

        }

        return $entity;

    }

}
