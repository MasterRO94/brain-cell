<?php

declare(strict_types=1);

namespace Brain\Cell\Transfer;

use Brain\Cell\Exception\RuntimeException;
use Brain\Cell\TransferEntityInterface;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * A collection of {@link TransferEntityInterface}.
 *
 * @see ArrayCollection
 */
class ResourceCollection extends ArrayCollection implements
    TransferEntityInterface
{
    /**
     * The entity class.
     *
     * @var string
     */
    protected $entityClass;

    /**
     * Return the entity class.
     *
     * @internal
     *
     * @throws RuntimeException When entity class is not present.
     */
    public function getEntityClassOrThrow(): string
    {
        if ($this->entityClass === null) {
            throw new RuntimeException('Missing entity class for collection');
        }

        return $this->entityClass;
    }

    /**
     * Set the strict entity class.
     *
     * @internal
     */
    public function setEntityClass(string $entityClass): void
    {
        $this->entityClass = $entityClass;
    }

    /**
     * Return the strict entity class if defined.
     *
     * @internal
     */
    public function getEntityClass(): string
    {
        return $this->entityClass;
    }

    /**
     * @param TransferEntityInterface $value
     *
     * @throws RuntimeException When $value is not an instance of TransferEntityInterface.
     * @throws RuntimeException When $value is not an instance of the set entity class.
     */
    public function add($value): bool
    {
        /** @var mixed $validation */
        $validation = $value;

        // We only accept instance of TransferEntityInterface in these collections.
        if (!($validation instanceof TransferEntityInterface)) {
            throw new RuntimeException('ResourceCollection::add() only accepts instances of TransferEntityInterface');
        }

        // Optionally if there was a entity class specified against the collection then we need to be strict.
        // Rejecting all $values given that are not of the given type.
        if ($this->entityClass !== null && !is_a($value, $this->entityClass)) {
            throw new RuntimeException(sprintf('ResourceCollection::add() only accepts instances of "%s"', $this->entityClass));
        }

        return parent::add($value);
    }
}
