<?php

namespace Brain\Cell\Transformer;

use Brain\Cell\Exception\RuntimeException;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\Collection;
use Brain\Cell\TransferEntityInterface;

use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

class ArrayEncoder
{

    public function encode(TransferEntityInterface $entity)
    {
        return $this->serialise($entity);


    }

    protected function serialise(TransferEntityInterface $entity)
    {

        if ($entity instanceof Collection) {
            $data = [];

            foreach ($entity->getData() as $resource) {

                if (!$resource instanceof TransferEntityInterface) {
                    throw new RuntimeException('Um');
                }

                $data[] = $this->serialise($resource);

            }

            return [
                'data' => $data
            ];

        }

        $class = new ReflectionClass(get_class($entity));
        $properties = $class->getProperties(ReflectionProperty::IS_PROTECTED);

        $resources = [];
        $collections = [];

        if ($entity instanceof AbstractResource) {
            $resources = $entity->getAssociatedResources() ?: [];
            $collections = $entity->getAssociatedCollections() ?: [];
        }

        $response = [];
        foreach ($properties as $property) {

            if ($property->getDeclaringClass()->getName() === AbstractResource::CLASS) {
                continue;
            }

            $property->setAccessible(true);
            $value = $property->getValue($entity);

            if ($value instanceof TransferEntityInterface) {
                if (isset($resources[$property->getName()]) || isset($collections[$property->getName()])) {
                    $value = $this->serialise($value);
                } else {
                    throw new RuntimeException(sprintf('The property "%s" has an unexpected TransferEntityInterface', $property->getName()));
                }
            } elseif (isset($collections[$property->getName()]) && (!$value instanceof Collection)) {
                $value = $this->serialise(new Collection);
            }

            $response[$property->getName()] = $value;

        }

        return $response;

    }

}
