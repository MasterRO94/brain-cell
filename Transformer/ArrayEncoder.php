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
            // Use reflection to get protected property values
            $property->setAccessible(true);
            $value = $property->getValue($resource);
            $snakeCasePropertyName = Inflector::tableize($property->getName());

            // All properties prefixed with "brain" are to be ignored
            if (substr($property->getName(), 0, 5) === 'brain') {
                continue;
            }

            // Certain fields can't be updated which is great
            // @todo remove setters for these and check missing setters here
            // @todo bear id in mind here - we need to be able to send id
            if (\in_array($property->getName(), [
                'status',
                'created',
                'updated',
                'dimensions',
                'shop',
                'productionHouse',
                'productionFinishDate',
            ])) {
                continue;
            }

            // Don't include data
            if ($property->getName() == 'data') {
                continue;
            }

            if ($value instanceof TransferEntityInterface) {
                // Some associated have to be sent as id (see comment above)
                if ($this->isIdResource($value)) {
                    if (method_exists($value, 'getAlias')) {
                        $value = $value->getAlias();
                    } else {
                        $value = $value->getId();
                    }

                // All other associated can be encoded hooray :)
                } elseif (isset($resources[$property->getName()])) {
                    $value = $this->encodeResource($value);
                } elseif (isset($collections[$property->getName()])) {
                    $result = [];

                    // Discard empty elements of collection
                    foreach ($this->encodeCollection($value) as $child) {
                        if (!empty($child)) {
                            $result[] = $child;
                        }
                    }

                    $value = $result;

                // Panic for unexpected transfer entity interface
                } else {
                    throw new RuntimeException(sprintf(
                        'Did not expect TransferEntityInterface in "%s" of "%s"',
                        $property->getName(),
                        get_class($resource)
                    ));
                }
            }

            if (empty($value)) {
                continue;
            }

            // Don't include values that haven't changed
            if ($this->valueIsUnchanged($originalData, $snakeCasePropertyName, $value)) {
                continue;
            }

            $data[$snakeCasePropertyName] = $value;
        }

        return $data;
    }

    /**
     * Some associated resources have to be sent as a UUID rather than as an
     * object. This fix has been implemented in PRWE
     * @todo copy it across and kill this bogus-ass method with fire
     * @param mixed $resource
     * @return bool
     */
    protected function isIdResource($resource)
    {
        if (!$resource instanceof AbstractResource) {
            return false;
        }

        return method_exists($resource, 'getId');
    }

    /**
     * @param array|null $originalData
     * @param string $snakeCasePropertyName
     * @param mixed $value
     * @return bool
     */
    protected function valueIsUnchanged($originalData, $snakeCasePropertyName, $value)
    {
        if ($value === null) {
            return true;
        }

        if ($originalData === null) {
            return false;
        }

        if (!\array_key_exists($snakeCasePropertyName, $originalData)) {
            return false;
        }

        if ($originalData[$snakeCasePropertyName] == $value) {
            return true;
        }

        return false;
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
