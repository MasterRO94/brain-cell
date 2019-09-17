<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
final class ClientEnvironmentResource extends AbstractResource implements
    ClientEnvironmentResourceInterface
{
    use ResourceIdentityTrait;

    /** @var ClientEnvironmentTypeResourceInterface */
    protected $type;

    /** @var string */
    protected $name;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'type' => ClientEnvironmentTypeResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): ClientEnvironmentTypeResourceInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }
}
