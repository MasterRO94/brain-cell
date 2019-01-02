<?php

declare(strict_types=1);

namespace Brain\Cell\Transfer;

use Brain\Cell\TransferEntityInterface;

use ReflectionClass;

/**
 * A entity resource factory.
 *
 * A factory for creating and populating protected fields against {@link TransferEntityInterface} entities.
 */
class EntityResourceFactory
{
    /**
     * Create and return the given $class.
     */
    public function create(string $class, ?int $id = null): TransferEntityInterface
    {
        /** @var TransferEntityInterface $class */
        $class = new $class();

        if ($id !== null) {
            $class = $this->setProperty($class, 'id', $id);
        }

        return $class;
    }

    /**
     * Set a protected property.
     *
     * @param mixed $value
     */
    public function setProperty(TransferEntityInterface $class, string $property, $value): TransferEntityInterface
    {
        $reflection = new ReflectionClass(get_class($class));
        $property = $reflection->getProperty($property);
        $property->setAccessible(true);
        $property->setValue($class, $value);

        return $class;
    }
}
