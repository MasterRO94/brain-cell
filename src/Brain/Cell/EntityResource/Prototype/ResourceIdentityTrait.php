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

    /**
     * Return the resource id.
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @deprecated Test the return of getId() instead.
     */
    public function hasId(): bool
    {
        return $this->id !== null;
    }

    /**
     * @deprecated This should not be used, if you are using it for tests mock the interface.
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }
}
