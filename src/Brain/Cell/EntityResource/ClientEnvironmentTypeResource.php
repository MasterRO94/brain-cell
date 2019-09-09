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
class ClientEnvironmentTypeResource extends AbstractResource implements ResourceIdentityInterface
{
    use ResourceIdentityTrait;

    /** @var string */
    protected $alias;

    /** @var string */
    protected $name;

    /** @var int */
    protected $priority;

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias(string $alias): void
    {
        $this->alias = $alias;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }
}
