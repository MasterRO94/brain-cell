<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Prototype;

interface ResourceIdentityInterface
{
    public function getId(): ?string;

    public function hasId(): bool;

    /**
     * @deprecated Do not use this, use hasId() and throw yourself.
     */
    public function getIdOrThrow(): string;

    public function setId(string $id): void;
}
