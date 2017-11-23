<?php

namespace Brain\Cell\Transfer;

use Brain;
use Brain\Cell\Exception\RuntimeException;
use Brain\Cell\TransferEntityInterface;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * A collection of {@link TransferEntityInterface}.
 *
 * @see ArrayCollection
 */
class ResourceCollection extends ArrayCollection implements
    Brain\Cell\TransferEntityInterface,
    Brain\Cell\Transfer\EntityMeta\MetaContainingInterface
{
    use Brain\Cell\Transfer\EntityMeta\MetaContainingTrait;

    /**
     * The entity class.
     *
     * @var string
     */
    protected $entityClass;

    /**
     * Return the entity class.
     *
     * @return string
     *
     * @throws RuntimeException if entity class is not present.
     *
     * @internal
     */
    public function getEntityClassOrThrow()
    {
        if (is_null($this->entityClass)) {
            throw new RuntimeException('Missing entity class for collection');
        }

        return $this->entityClass;
    }

    /**
     * Set the strict entity class.
     *
     * @param string $entityClass
     *
     * @internal
     */
    public function setEntityClass($entityClass)
    {
        $this->entityClass = $entityClass;
    }

    /**
     * Return the strict entity class if defined.
     *
     * @return string
     *
     * @internal
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * {@inheritdoc}
     *
     * @param TransferEntityInterface $value
     *
     * @throws RuntimeException when $value is not an instance of TransferEntityInterface
     * @throws RuntimeException when $value is not an instance of the set entity class
     */
    public function add($value)
    {

        //  We only accept instance of TransferEntityInterface in these collections.
        if (!$value instanceof TransferEntityInterface) {
            throw new RuntimeException(sprintf('ResourceCollection::add() only accepts instances of TransferEntityInterface'));
        }

        //  Optionally if there was a entity class specified against the collection then we need to be strict.
        //  Rejecting all $values given that are not of the given type.
        if (!is_null($this->entityClass) && !is_a($value, $this->entityClass)) {
            throw new RuntimeException(sprintf('ResourceCollection::add() only accepts instances of "%s"', $this->entityClass));
        }

        return parent::add($value);
    }
}
