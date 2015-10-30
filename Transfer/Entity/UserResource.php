<?php

namespace Brain\Cell\Transfer\Entity;

use Brain\Cell\Transfer\AbstractCollection;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\Entity\User\AccessTokenCollection;

class UserResource extends AbstractResource
{

    protected $id;

    protected $email;

    protected $accessTokens;

    protected $client;

    /**
     * @return AbstractResource[]
     */
    public function getAssociatedResources()
    {
        return [
            'client' => ClientResource::CLASS
        ];
    }

    /**
     * @return AbstractCollection[]
     */
    public function getAssociatedCollections()
    {
        return [
            'accessTokens' => AccessTokenCollection::CLASS
        ];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccessTokens()
    {
        return $this->accessTokens;
    }

    /**
     * @param AccessTokenCollection $accessTokens
     * @return UserResource
     */
    public function setAccessTokens(AccessTokenCollection $accessTokens)
    {
        $this->accessTokens = $accessTokens;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param ClientResource $client
     * @return UserResource
     */
    public function setClient(ClientResource $client)
    {
        $this->client = $client;
        return $this;
    }

}
