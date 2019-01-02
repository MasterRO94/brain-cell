<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource;

use Brain\Cell\Transfer\AbstractResource;

/**
 * A resource representing a type of product.
 */
class ProductTypeResource extends AbstractResource
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $alias;

    /** @var string */
    protected $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): void
    {
        $this->alias = $alias;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
