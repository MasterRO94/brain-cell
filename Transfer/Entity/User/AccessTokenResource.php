<?php

namespace Brain\Cell\Transfer\Entity\User;

use Brain\Cell\Transfer\AbstractResourceCollection;
use Brain\Cell\Transfer\AbstractResource;

class AccessTokenResource extends AbstractResource
{

    protected $id;

    protected $token;

    /**
     * @return AbstractResource[]
     */
    public function getAssociatedResources()
    {
        return [];
    }

    /**
     * @return AbstractResourceCollection[]
     */
    public function getAssociatedCollections()
    {
        return [];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     * @return AccessTokenResource
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

}
