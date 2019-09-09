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
class ClientEnvironmentResource extends AbstractResource implements ResourceIdentityInterface
{
    use ResourceIdentityTrait;

    /** @var ClientEnvironmentTypeResource */
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

    public function getType(): ClientEnvironmentTypeResource
    {
        return $this->type;
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
