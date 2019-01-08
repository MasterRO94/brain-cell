<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Prototype;

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

    public function hasId(): bool
    {
        return $this->id !== null;
    }

    /**
     * Set the identity.
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }
}
