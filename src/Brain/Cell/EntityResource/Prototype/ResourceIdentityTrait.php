<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Prototype;

use RuntimeException;

/**
 * A trait for resources with uuid public id.
 */
trait ResourceIdentityTrait
{
    /** @var string|null */
    protected $id;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getIdOrThrow(): string
    {
        if ($this->id === null) {
            throw new RuntimeException("Couldn't retrieve resource's id, because it's not set.");
        }

        return $this->id;
    }

    /**
     * Set the identity.
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }
}
