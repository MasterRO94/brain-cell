<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource;

use Brain\Cell\Transfer\AbstractResource;

class WhoAmIResponseResource extends AbstractResource
{
    /** @var UserResource */
    protected $user;

    /** @var ClientResource */
    protected $client;

    /** @var ClientEnvironmentResourceInterface */
    protected $environment;

    /** @var mixed[] */
    protected $application;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'user' => UserResource::class,
            'client' => ClientResource::class,
            'environment' => ClientEnvironmentResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getUnstructuredFields(): array
    {
        return [
            'application',
        ];
    }

    public function getUser(): UserResource
    {
        return $this->user;
    }

    public function getClient(): ClientResource
    {
        return $this->client;
    }

    public function getEnvironment(): ClientEnvironmentResourceInterface
    {
        return $this->environment;
    }

    /**
     * @return mixed[]
     */
    public function getApplication(): array
    {
        return $this->application;
    }
}
