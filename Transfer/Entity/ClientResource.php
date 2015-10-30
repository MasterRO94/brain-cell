<?php

namespace Brain\Cell\Transfer\Entity;

use Brain\Cell\Transfer\AbstractCollection;
use Brain\Cell\Transfer\AbstractResource;

class ClientResource extends AbstractResource
{

    protected $id;

    protected $name;

    /**
     * @return AbstractResource[]
     */
    public function getAssociatedResources()
    {
        return [];
    }

    /**
     * @return AbstractCollection[]
     */
    public function getAssociatedCollections()
    {
        return [];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return ClientResource
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

}
