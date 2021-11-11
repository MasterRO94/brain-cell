<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class TurnaroundResource extends AbstractResource
{
    use ResourceIdentityTrait;

    /** @var string */
    protected $alias;

    /** @var string */
    protected $name;

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
