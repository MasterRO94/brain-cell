<?php

declare(strict_types=1);

namespace Brain\Cell\Transformer;

use Brain\Cell\AbstractTransformer;
use Brain\Cell\Exception\RuntimeException;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;

use Doctrine\Common\Inflector\Inflector;

use DateTime;
use ReflectionClass;
use ReflectionException;

/**
 * A decoder for hydrating {@link TransferEntityInterface}'s from arrays.
 */
class ArrayDecoder extends AbstractTransformer
{
    public const UUID_REGEX = '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/';

    /**
     * Decode the given $data and populate the given {@link TransferEntityInterface}.
     *
     * @param mixed[] $data
     *
     * @throws ReflectionException
     */
    public function decode(TransferEntityInterface $entity, array $data): TransferEntityInterface
    {
        // If we are decoding a collection of resources..
        if ($entity instanceof ResourceCollection) {
            return $this->decodeCollection($entity, $data);
        }

        // If we are decoding a resource..
        if ($entity instanceof AbstractResource) {
            return $this->decodeResource($entity, $data);
        }

        // The decoder may not support serialising all transfer entities.
        throw new RuntimeException(sprintf('Unexpected TransferEntityInterface "%s"', get_class($entity)));
    }

    /**
     * Populate a {@link AbstractResource} with the given $data.
     *
     * @param mixed[] $data
     *
     * @throws ReflectionException
     */
    protected function decodeResource(AbstractResource $resource, array $data): AbstractResource
    {
        // Serialisation is done on the properties of the transfer objects.
        // For this we need to make use of reflection to get the protected properties.
        $class = new ReflectionClass(get_class($resource));

        // Return any associations that we should be validating.
        // Note also that these look "deprecated" but are actually "internal".
        $resources = $resource->getAssociatedResources();
        $collections = $resource->getAssociatedCollections();
        $dateTimeProperties = $resource->getDateTimeProperties();

        // A collection of properties against the object that we populated.
        // Used later to validate missing properties.
        $properties = [];
        foreach ($class->getProperties() as $property) {
            // All properties prefixed with "brain" are to be ignored.
            // There is a reason why we cannot make use of special characters as I intended to do, cant remember.
            if (substr($property->getName(), 0, 5) === 'brain') {
                continue;
            }

            $properties[$property->getName()] = $property;
        }

        foreach ($data as $propertyName => $value) {
            $camelCasePropertyName = Inflector::camelize($propertyName);

            // The API will change and throwing in the case of an unexpected property was a great idea at first,
            // but actually its a pain to handle. Instead just ignore properties returned, if the property is needed
            // then people can upgrade to the latest release.
            if (!$class->hasProperty($camelCasePropertyName)) {
                continue;
            }

            $property = $class->getProperty($camelCasePropertyName);

            // Decode resources.
            if (isset($resources[$property->getName()])) {
                $child = new $resources[$property->getName()]();
                if (is_array($value)) {
                    // we have a full-fledged object...
                    $value = $this->decodeResource($child, $value);
                } else {
                    // we only have an ID or possibly an alias
                    if (preg_match(static::UUID_REGEX, (string) $value)) {
                        $value = $this->decodeResource($child, ['id' => $value]);
                    } else {
                        $value = $this->decodeResource($child, ['alias' => $value]);
                    }
                }

                // Decode collections.
            } elseif (isset($collections[$property->getName()])) {
                $collection = new ResourceCollection();
                $collection->setEntityClass($collections[$property->getName()]);
                $value = $this->decodeCollection($collection, $value);

                // Unstructured fields - a different decoder would convert to array
            } elseif (in_array($property->getName(), $dateTimeProperties)) {
                $value = $value ? new DateTime($value) : $value;
            }

            // Using reflection set the protected property.
            $property->setAccessible(true);
            $property->setValue($resource, $value);

            // Remove each property so we can see whats left.
            unset($properties[$camelCasePropertyName]);
        }

        // Store the raw data against the resource for use by the encoder
        $resource->setBrainData($data);

        return $resource;
    }

    /**
     * Populate a {@link ResourceCollection} with the given $data.
     *
     * @param mixed[] $data
     */
    protected function decodeCollection(ResourceCollection $collection, array $data): ResourceCollection
    {
        foreach ($data as $resource) {
            $entity = $collection->getEntityClassOrThrow();
            $entity = new $entity();

            $entity = $this->decodeResource($entity, $resource);
            $collection->add($entity);
        }

        return $collection;
    }
}
