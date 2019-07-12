<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Prototype;

interface ResourceAliasInterface
{
    /**
     * Return the resource alias.
     */
    public function getAlias(): ?string;

    /**
     * @deprecated Test the return of getAlias() instead.
     */
    public function hasAlias(): bool;

    /**
     * @deprecated This should not be used, if you are using it for tests mock the interface.
     */
    public function setAlias(string $alis): void;
}
