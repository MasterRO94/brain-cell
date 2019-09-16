<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource;

use Brain\Cell\EntityResource\Country\AddressResource;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
final class ClientEnvironmentTypeResource extends AbstractResource implements
    ClientEnvironmentTypeResourceInterface
{
    use ResourceIdentityTrait;

    /** @var string */
    protected $alias;

    /** @var string */
    protected $name;

    /** @var int */
    protected $priority;

    /**
     * {@inheritdoc}
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getPriority(): int
    {
        return $this->priority;
    }
}
