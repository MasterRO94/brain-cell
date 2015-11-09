<?php

namespace Brain\Cell\Transfer;

use Brain;

use Doctrine;
use Doctrine\Common\Collections\ArrayCollection;

class ResourceCollection implements
    Brain\Cell\TransferEntityInterface
{

    /** @var string */
    protected $entityClass;

    /** @var ArrayCollection|AbstractResource[] */
    protected $data;

    /** @var ArrayCollection */
    protected $links;

    /** @var mixed */
    protected $pagination;

    public function __construct($entityClass = null)
    {
        $this->entityClass = $entityClass;
        $this->data = new ArrayCollection;
        $this->links = new ArrayCollection;
    }

    /**
     * @return string
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * @return ArrayCollection|AbstractResource[]
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @return mixed
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    /**
     * @param $pagination
     * @return $this
     */
    public function setPagination($pagination)
    {
        $this->pagination = $pagination;
        return $this;
    }

}
