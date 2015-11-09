<?php

namespace Brain\Cell\Transfer;

use Brain;
use Brain\Cell\Exception\RuntimeException;
use Brain\Cell\TransferEntityInterface;

use Doctrine;
use Doctrine\Common\Collections\ArrayCollection;

class ResourceCollection extends ArrayCollection implements
    Brain\Cell\TransferEntityInterface
{

    /** @var string */
    protected $entityClass;

    /**
     * @return string
     *
     * @internal
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * @param string $entityClass
     *
     * @internal
     */
    public function setEntityClass($entityClass)
    {
        $this->entityClass = $entityClass;
    }

    /**
     * {@inheritDoc}
     *
     * @param TransferEntityInterface $value
     * @throws RuntimeException when $value is not an instance of TransferEntityInterface
     * @throws RuntimeException when $value is not an instance of the set entity class
     */
    public function add($value)
    {

        if (!$value instanceof TransferEntityInterface) {
            throw new RuntimeException(sprintf('ResourceCollection::add() only accepts instances of TransferEntityInterface'));
        }

        if (!is_null($this->entityClass) && !is_a($value, $this->entityClass)) {
            throw new RuntimeException(sprintf('ResourceCollection::add() only accepts instances of "%s"', $this->entityClass));
        }

        return parent::add($value);

    }


}
