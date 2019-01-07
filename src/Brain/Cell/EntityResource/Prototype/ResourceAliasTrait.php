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

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function hasAlias(): bool
    {
        return $this->alias !== null;
    }

    public function setAlias(string $alias): void
    {
        $this->alias = $alias;
    }
}
