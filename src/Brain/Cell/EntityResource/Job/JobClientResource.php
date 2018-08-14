<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\ClientResource;
use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;

final class JobClientResource extends AbstractResource
{
    use ResourcePublicIdTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;

    public const ROLE_ORIGIN = 'origin';
    public const ROLE_PRODUCTION = 'production';
    public const ROLE_PREPRESS = 'prepress';

    /** @var string */
    protected $role;

    /** @var ClientResource */
    protected $client;

    /** @var bool */
    protected $isPrimary;

    /** @var bool */
    protected $isActive;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'client' => ClientResource::class,
            'createdAt' => DateResource::class,
            'updatedAt' => DateResource::class,
        ];
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * @return ClientResource
     */
    public function getClient(): ClientResource
    {
        return $this->client;
    }

    /**
     * @param ClientResource $client
     */
    public function setClient(ClientResource $client): void
    {
        $this->client = $client;
    }

    /**
     * @return bool
     */
    public function isPrimary(): bool
    {
        return $this->isPrimary;
    }

    /**
     * @param bool $isPrimary
     */
    public function setIsPrimary(bool $isPrimary): void
    {
        $this->isPrimary = $isPrimary;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }
}
