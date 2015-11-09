<?php

namespace Brain\Cell\Transfer;

use Brain\Cell\TransferEntityInterface;

class EntityFactory
{

    /**
     * @param string $class
     * @param null|int $id
     * @return TransferEntityInterface
     */
    public function create($class, $id = null)
    {
        /** @var TransferEntityInterface $class */
        $class = new $class;

        if (is_integer($id)) {
            $class = $this->setProperty($class, 'id', $id);
        }

        return $class;

    }

    /**
     * @param TransferEntityInterface $class
     * @param string $property
     * @param mixed $id
     * @return TransferEntityInterface
     */
    public function setProperty($class, $property, $id)
    {
        $reflection = new \ReflectionClass(get_class($class));
        $property = $reflection->getProperty($property);
        $property->setAccessible(true);
        $property->setValue($class, $id);
        return $class;
    }

}
