<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Prototype;

interface ResourceIdentityInterface
{
    public function getId(): ?string;

    public function getIdOrThrow(): string;

    public function setId(string $id): void;
}
