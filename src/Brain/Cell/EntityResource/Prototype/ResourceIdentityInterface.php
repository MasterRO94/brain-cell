<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Prototype;

interface ResourceIdentityInterface
{
    /**
     * Return the resource id.
     */
    public function getId(): ?string;

    /**
     * @deprecated Test the return of getId() instead.
     */
    public function hasId(): bool;

    /**
     * @deprecated This should not be used, if you are using it for tests mock the interface.
     */
    public function setId(string $id): void;
}
