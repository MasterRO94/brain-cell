<?php

declare(strict_types=1);

namespace Brain\Cell\Transformer;

use Brain\Cell\AbstractTransformer;
use Brain\Cell\EntityResource\Common\AbstractStatusResource;
use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\Exception\RuntimeException;
use Brain\Cell\Logical\ArrayEncoderSerialisationOptions;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;

use Doctrine\Common\Inflector\Inflector;

use DateTime;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

/**
 * An encoder for transforming {@link TransferEntityInterface} to arrays.
 */
class ArrayEncoder extends AbstractTransformer
{
    /**
     * Encode the given {@link TransferEntityInterface} and return the serialised view.
     *
     * @return mixed[]
     */
    public function encode(
        TransferEntityInterface $entity,
        ?ArrayEncoderSerialisationOptions $options = null
    ): array {
        if (!$options) {
            $options = new ArrayEncoderSerialisationOptions();
        }

        // If we are encoding a collection of resources..
        if ($entity instanceof ResourceCollection) {
            return $this->encodeCollection($entity, $options);
        }

        // If we are encoding a resource..
        if ($entity instanceof AbstractResource) {
            return $this->encodeResource($entity, $options);
        }

        // The encoder may not support encoding all transfer entities.
        throw new RuntimeException(sprintf('Unexpected TransferEntityInterface "%s"', get_class($entity)));
    }

    /**
     * Serialise a {@link AbstractResource}.
     *
     * @return mixed[]
     *
     * @throws ReflectionException
     */
    protected function encodeResource(AbstractResource $resource, ArrayEncoderSerialisationOptions $options): array
    {
        $data = [];

        // Serialisation is done on the properties of the transfer objects.
        // For this we need to make use of reflection to get the protected properties.
        $class = new ReflectionClass(get_class($resource));
        $properties = $class->getProperties(ReflectionProperty::IS_PROTECTED);

        // Return any associations that we should be validating.
        // Note also that these look "deprecated" but are actually "internal".
        $resources = $resource->getAssociatedResources();
        $collections = $resource->getAssociatedCollections();

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
                'created',
                'updated',
                'createdAt',
                'updatedAt',
                'shop',
                'productionSheetCount',
                'productionHouse',
                'productionFinishDate',
                'dispatches',
            ])) {
                continue;
            }

            if ($value instanceof TransferEntityInterface) {
                // Some associated have to be sent as id (see comment above)
                if ($this->isIdResourceAndShouldSerialiseAsId($value, $options)) {
                    $value = $this->getValueForIdResource($value, $options);
                } elseif ($property->getName() === 'status') {
                    /** @var AbstractStatusResource $subject */
                    $subject = $value;

                    $value = $subject->getCanonical();

                    // All other associated can be encoded hooray :)
                } elseif (isset($resources[$property->getName()])) {
                    if ($resources[$property->getName()] === DateResource::class) {
                        /** @var DateResource $subject */
                        $subject = $value;

                        $value = $subject->getIso();
                    } else {
                        $value = $this->encodeResource($value, $options);
                    }
                } elseif (isset($collections[$property->getName()])) {
                    $result = [];

                    // Discard empty elements of collection
                    foreach ($this->encodeCollection($value, $options) as $child) {
                        if (empty($child)) {
                            continue;
                        }

                        $result[] = $child;
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
            } elseif ($value instanceof DateTime) {
                $value = $value->format('c');
            }

            // Ignore empty arrays, but don't ignore 0 or false
            if ($value === null || (is_array($value) && empty($value))) {
                continue;
            }

            if ($value === null) {
                continue;
            }

            $data[$snakeCasePropertyName] = $value;
        }

        return $data;
    }

    /**
     * Some associated resources have to be sent as a UUID rather than as an
     * object. This fix has been implemented in PRWE.
     *
     * @todo copy it across and kill this bogus-ass method with fire
     *
     * @param mixed $resource
     */
    protected function isIdResource($resource): bool
    {
        if (!$resource instanceof AbstractResource) {
            return false;
        }

        return method_exists($resource, 'getId');
    }

    /**
     * @param mixed $resource
     */
    protected function isIdResourceAndShouldSerialiseAsId(
        $resource,
        ArrayEncoderSerialisationOptions $options
    ): bool {
        return $options['serialiseResourceIdInsteadOfWholeBodyIfPossible']
            && $this->isIdResource($resource);
    }

    /**
     * @return mixed[]|string
     *
     * @throws ReflectionException
     */
    protected function getValueForIdResource(
        AbstractResource $resource,
        ArrayEncoderSerialisationOptions $options
    ) {
        // @todo create IdResource class/trait
        assert(method_exists($resource, 'getId'));

        if ($options['preferSerialisingResourceAliasOverId']
            && method_exists($resource, 'getAlias')
            && $resource->getAlias()
        ) {
            return $resource->getAlias();
        }

        if ($resource->hasId()) {
            return $resource->getId();
        }

        // no ID or alias so this is a new object...
        return $this->encodeResource($resource, $options);
    }

    /**
     * Serialise a {@link ResourceCollection}.
     *
     * @return mixed[]
     *
     * @throws ReflectionException
     */
    protected function encodeCollection(
        ResourceCollection $collection,
        ArrayEncoderSerialisationOptions $options
    ): array {
        $resources = [];

        // Loop over all the resources in the collection and serialise them.
        foreach ($collection as $resource) {
            $resources[] = $this->isIdResourceAndShouldSerialiseAsId($resource, $options)
                ? $this->getValueForIdResource($resource, $options)
                : $this->encodeResource($resource, $options);
        }

        return $resources;
    }
}
