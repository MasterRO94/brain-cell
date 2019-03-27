<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Prototype;

interface ResourceAliasInterface
{
    public function getAlias(): string;

    public function hasAlias(): bool;

    public function setAlias(string $alis): void;
}
