<?php

namespace Brain\Cell\Tests\Mock\Association;

use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\Collection;

class SimpleResourceCollectionAssociationMock extends AbstractResource
{

    /** @var int */
    protected $id;

    /** @var Collection|SimpleResourceMock[] */
    protected $associations;

    /**
     * @param int $id
     * @return static
     */
    public static function create($id)
    {
        $instance = new static;
        $instance->setId($id);
        return $instance;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Collection|SimpleResourceMock[]
     */
    public function getAssociations()
    {
        return $this->associations;
    }

    /**
     * @param Collection|SimpleResourceMock[] $associations
     * @return $this
     */
    public function setAssociations($associations)
    {
        $this->associations = $associations;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'associations' => SimpleResourceMock::CLASS
        ];
    }


}
