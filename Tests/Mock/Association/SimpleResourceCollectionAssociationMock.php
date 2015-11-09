<?php

namespace Brain\Cell\Tests\Mock\Association;

use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

class SimpleResourceCollectionAssociationMock extends AbstractResource
{

    /** @var int */
    protected $id;

    /** @var ResourceCollection|SimpleResourceMock[] */
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
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'associations' => SimpleResourceMock::CLASS
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
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return ResourceCollection|SimpleResourceMock[]
     */
    public function getAssociations()
    {
        return $this->associations;
    }

    /**
     * @param ResourceCollection|SimpleResourceMock[] $associations
     * @return $this
     */
    public function setAssociations(ResourceCollection $associations)
    {
        $this->associations = $associations;
        return $this;
    }

}
