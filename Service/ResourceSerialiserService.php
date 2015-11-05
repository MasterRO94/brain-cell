<?php

namespace Brain\Cell\Service;

use Brain\Cell\Exception\RuntimeException;
use Brain\Cell\Transfer\AbstractResourceCollection;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\Meta\Link\ResourceCollectionLink;
use Brain\Cell\Transfer\Meta\Link\ResourceLink;
use Brain\Cell\Transfer\Meta\LinkInterface;
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
        $serialiser = $this->getSerialiser();
        return $serialiser->serialize($entity, 'json');
    }

    /**
     * @param array|string $json
     * @param string $entityClassName
     * @return AbstractResource
     */
    public function deserialise($json, $entityClassName)
    {

        if (is_string($json)) {
            $json = json_decode($json, true);
        }

        /** @var AbstractResource $entity */
        $entity = $this->hydrateResourceEntity($json, $entityClassName);

        $this->recursiveDeserialise($entity, $json);

        return $entity;

    }

    /**
     * @param TransferEntityInterface $entity
     * @param int $value
     * @return TransferEntityInterface
     */
    public function setId(TransferEntityInterface $entity, $value)
    {
        return $this->setProtectedProperty($entity, 'id', $value);
    }

    /**
     * @param TransferEntityInterface $entity
     * @param string $property
     * @param mixed $value
     * @return TransferEntityInterface
     */
    protected function setProtectedProperty(TransferEntityInterface $entity, $property, $value)
    {
        $class = new \ReflectionClass(get_class($entity));
        $property = $class->getProperty($property);
        $property->setAccessible(true);
        $property->setValue($entity, $value);
        return $entity;
    }

    /**
     * @param TransferEntityInterface $entity
     * @param array $data
     */
    protected function recursiveDeserialise(TransferEntityInterface $entity, array $data)
    {
        $accessor = PropertyAccess::createPropertyAccessor();
        if ($entity instanceof AbstractResource) {

            if (!is_null($resources = $entity->getAssociatedResources())) {
                foreach ($resources as $property => $resource) {
                    $resourceData = $data[$property];

                    if (is_null($resourceData)) {
                        throw new RuntimeException(sprintf('Association returned was not as expected for "%s"', $property));
                    }

                    $link = null;

                    if ($this->isResourceDataCollectionArray($resourceData)) {
                        $link = $this->resolveResourceDataMetaLinkCollection($resourceData);

                        $resourceData = [];
                        if ($link instanceof ResourceLink) {
                            $resourceData['id'] = $link->getId();
                        }

                    }

                    $resource = $this->hydrateResourceEntity($resourceData, $resource, $link);
                    $accessor->setValue($entity, $property, $resource);

                }
            }

            if (!is_null($collections = $entity->getAssociatedCollections())) {
                foreach ($collections as $property => $collection) {

                    /** @var AbstractResourceCollection $collection */
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
     * @param null|LinkInterface $link
     * @return AbstractResource
     */
    protected function hydrateResourceEntity(array $data, $entityClassName, LinkInterface $link = null)
    {
        $data = $this->removeAssociatedAttributes(new $entityClassName, $data);

        /** @var AbstractResource $entity */
        $entity = $this->getSerialiser()->deserialize(json_encode($data), $entityClassName, 'json');

        $hydrated = $link instanceof LinkInterface;
        $this->setProtectedProperty($entity, '___isResourceFullyHydrated', !$hydrated);
        return $entity;

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

        $normaliser = new PropertyNormalizer;
        $normaliser->setIgnoredAttributes([
            '___isResourceFullyHydrated'
        ]);

        $encoded = new JsonEncoder;

        return new Serializer([$normaliser], [$encoded]);

    }

    /**
     * @see http://stackoverflow.com/questions/173400/how-to-check-if-php-array-is-associative-or-sequential/265144#265144
     *
     * @param array $data
     * @return bool
     */
    protected function isResourceDataCollectionArray(array $data)
    {
        return array_values($data) === $data;
    }

    /**
     * @param array $data
     * @return null|LinkInterface
     */
    protected function resolveResourceDataMetaLinkCollection(array $data)
    {

        if (!$this->isResourceDataCollectionArray($data)) {
            return null;
        }

        $data = $data[0];

        //  A resource related link with identity.
        if ((count($data) === 3) && isset($data['id']) && isset($data['rel']) && isset($data['href'])) {
            return new ResourceLink($data['id'], $data['rel'], $data['href']);
        }

        //  A resource collection related link without identity.
        if ((count($data) === 2) && isset($data['rel']) && isset($data['href'])) {
            return new ResourceCollectionLink($data['rel'], $data['href']);
        }

        return null;

    }

}
