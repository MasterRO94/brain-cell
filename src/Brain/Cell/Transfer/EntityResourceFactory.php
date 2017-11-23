<?php

namespace Brain\Cell\Transfer;

use Brain\Cell\TransferEntityInterface;

/**
 * A entity resource factory.
 *
 * A factory for creating and populating protected fields against {@link TransferEntityInterface} entities.
 */
class EntityResourceFactory
{

    /**
     * Create and return the given $class.
     *
     * @param string $class
     * @param null|int $id
     * @return TransferEntityInterface
     */
    public function create($class, $id = null)
    {
        /** @var TransferEntityInterface $class */
        $class = new $class;

        if (!is_null($id)) {
            $class = $this->setProperty($class, 'id', $id);
        }

        return $class;

    }

    /**
     * Set a protected property.
     *
     * @param TransferEntityInterface $class
     * @param string $property
     * @param mixed $value
     * @return TransferEntityInterface
     */
    public function setProperty($class, $property, $value)
    {
        $reflection = new \ReflectionClass(get_class($class));
        $property = $reflection->getProperty($property);
        $property->setAccessible(true);
        $property->setValue($class, $value);
        return $class;
    }

}
