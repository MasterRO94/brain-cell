<?php

namespace Brain\Cell\Transformer;

use Brain;
use Brain\Cell\Exception\RuntimeException;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;

use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

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
        return $this->serialise($entity);
    }

    protected function serialise(TransferEntityInterface $entity)
    {

        if ($entity instanceof ResourceCollection) {
            $data = [];

            foreach ($entity->getData() as $resource) {

                if (!$resource instanceof AbstractResource) {
                    throw new RuntimeException('All entries within a ResourceCollection needs to be an instance of AbstractResource');
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

            $property->setAccessible(true);
            $value = $property->getValue($entity);

            if ($value instanceof TransferEntityInterface) {
                if (isset($resources[$property->getName()]) || isset($collections[$property->getName()])) {
                    $value = $this->serialise($value);
                } else {
                    throw new RuntimeException(sprintf(
                        'Was not expected EntityResource at "%s" of "%s"',
                        $property->getName(),
                        get_class($entity)
                    ));
                }
            } elseif (isset($collections[$property->getName()]) && (!$value instanceof ResourceCollection)) {
                $value = $this->serialise(new ResourceCollection);
            }

            $response[$property->getName()] = $value;

        }

        return $response;

    }

}
