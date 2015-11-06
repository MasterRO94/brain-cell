<?php

namespace Brain\Cell\Transfer\Entity;

use Brain\Cell\Transfer\AbstractResourceCollection;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\Collection;
use Brain\Cell\Transfer\Entity\User\AccessTokenResourceCollection;
use Brain\Cell\Transfer\Meta\MetaResourceCollection;

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
     * @return AbstractResourceCollection[]
     */
    public function getAssociatedCollections()
    {
        return [
            'accessTokens' => AccessTokenResourceCollection::CLASS
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
     * @param Collection $accessTokens
     * @return $this
     */
    public function setAccessTokens($accessTokens)
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
     * @return $this
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

}
