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

    /** @var mixed[] */
    protected $application;

    /** @var mixed[] */
    protected $environment;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'user' => UserResource::class,
            'client' => ClientResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getUnstructuredFields(): array
    {
        return [
            'application',
            'environment',
        ];
    }

    public function getUser(): UserResource
    {
        return $this->user;
    }

    public function setUser(UserResource $user): void
    {
        $this->user = $user;
    }

    public function getClient(): ClientResource
    {
        return $this->client;
    }

    public function setClient(ClientResource $client): void
    {
        $this->client = $client;
    }

    /**
     * @return mixed[]
     */
    public function getApplication(): array
    {
        return $this->application;
    }

    /**
     * @param mixed[] $application
     */
    public function setApplication(array $application): void
    {
        $this->application = $application;
    }

    /**
     * @return mixed[]
     */
    public function getEnvironment(): array
    {
        return $this->environment;
    }

    /**
     * @param mixed[] $environment
     */
    public function setEnvironment(array $environment): void
    {
        $this->environment = $environment;
    }
}
