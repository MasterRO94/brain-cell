<?php

namespace Brain\Cell\EntityResource;

use Brain\Cell\Transfer\AbstractResource;

class WhoAmIResponseResource extends AbstractResource
{
    /** @var UserResource */
    protected $user;

    /** @var ClientResource */
    protected $client;

    /** @var array */
    protected $application;

    /** @var array */
    protected $environment;

    public function getAssociatedResources(): array
    {
        return [
            'user' => UserResource::class,
            'client' => ClientResource::class,
        ];
    }

    public function getUnstructuredFields(): array
    {
        return [
            'application',
            'environment'
        ];
    }

    /**
     * @return UserResource
     */
    public function getUser(): UserResource
    {
        return $this->user;
    }

    /**
     * @param UserResource $user
     */
    public function setUser(UserResource $user)
    {
        $this->user = $user;
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
    public function setClient(ClientResource $client)
    {
        $this->client = $client;
    }

    /**
     * @return array
     */
    public function getApplication(): array
    {
        return $this->application;
    }

    /**
     * @param array $application
     */
    public function setApplication(array $application)
    {
        $this->application = $application;
    }

    /**
     * @return array
     */
    public function getEnvironment(): array
    {
        return $this->environment;
    }

    /**
     * @param array $environment
     */
    public function setEnvironment(array $environment)
    {
        $this->environment = $environment;
    }
}
