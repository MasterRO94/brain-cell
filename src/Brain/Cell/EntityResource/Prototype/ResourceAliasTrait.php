<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Prototype;

/**
 * A trait for resources with public alias.
 */
trait ResourceAliasTrait
{
    /** @var string|null */
    protected $alias;

    /**
     * Return the resource alias.
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * @deprecated Test the return of getAlias() instead.
     */
    public function hasAlias(): bool
    {
        return $this->alias !== null;
    }

    /**
     * @deprecated This should not be used, if you are using it for tests mock the interface.
     */
    public function setAlias(string $alias): void
    {
        $this->alias = $alias;
    }
}
