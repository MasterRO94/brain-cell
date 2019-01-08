<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Prototype;

interface ResourceIdentityInterface
{
    public function getId(): ?string;

    public function hasId(): bool;

    public function setId(string $id): void;
}
