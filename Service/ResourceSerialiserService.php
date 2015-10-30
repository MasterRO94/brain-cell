<?php

namespace Brain\Cell\Service;

use Brain\Cell\Transfer\AbstractCollection;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\TransferEntityInterface;

use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class ResourceSerialiserService
{

    /**
     * @param TransferEntityInterface $entity
     * @return string
     */
    public function serialise(TransferEntityInterface $entity)
    {
        return $this->getSerialiser()->serialize($entity, 'json');
    }

    /**
     * @param array $json
     * @param string $entityClassName
     * @return AbstractResource
     */
    public function deserialise(array $json, $entityClassName)
    {

        /** @var AbstractResource $entity */
        $entity = $this->hydrateResourceEntity($json, $entityClassName);

        $this->recursiveDeserialise($entity, $json);

        return $entity;

    }

    /**
     * @param TransferEntityInterface $entity
     * @param int $id
     * @return TransferEntityInterface
     */
    public function setId(TransferEntityInterface $entity, $id)
    {
        $json = json_encode(['id' => $id]);
        return $this->getSerialiser()->deserialize($json, get_class($entity), 'json', [
            'object_to_populate' => $entity
        ]);
    }

    /**
     * @param TransferEntityInterface $entity
     * @param array $data
     */
    protected function recursiveDeserialise(TransferEntityInterface $entity, array $data)
    {
        $accessor = PropertyAccess::createPropertyAccessor();
        if ($entity instanceof AbstractResource) {

            if (!is_null($entity->getAssociatedResources())) {
                foreach ($entity->getAssociatedResources() as $property => $resource) {
                    $resource = $this->hydrateResourceEntity($data[$property], $resource);
                    $accessor->setValue($entity, $property, $resource);
                }
            }

            if (!is_null($entity->getAssociatedCollections())) {
                foreach ($entity->getAssociatedCollections() as $property => $collection) {

                    /** @var AbstractCollection $collection */
                    $collection = new $collection;

                    foreach ($data[$property] as $resource) {
                        $collection->add($this->hydrateResourceEntity($resource, $collection->getResourceClassName()));
                    }

                    $accessor->setValue($entity, $property, $collection);
                }
            }

        }
    }

    /**
     * @param array $data
     * @param string $entityClassName
     * @return AbstractResource
     */
    protected function hydrateResourceEntity(array $data, $entityClassName)
    {
        $data = $this->removeAssociatedAttributes(new $entityClassName, $data);
        return $this->getSerialiser()->deserialize(json_encode($data), $entityClassName, 'json');
    }

    protected function removeAssociatedAttributes(TransferEntityInterface $entity, array $data)
    {
        if ($entity instanceof AbstractResource) {

            if (!is_null($entity->getAssociatedResources())) {
                foreach (array_keys($entity->getAssociatedResources()) as $key) {
                    unset($data[$key]);
                }
            }

            if (!is_null($entity->getAssociatedCollections())) {
                foreach (array_keys($entity->getAssociatedCollections()) as $key) {
                    unset($data[$key]);
                }
            }

            return $data;

        } else {
            return $data;
        }
    }

    protected function getSerialiser()
    {
        return new Serializer(
            [new PropertyNormalizer],
            [new JsonEncoder]
        );
    }

}
