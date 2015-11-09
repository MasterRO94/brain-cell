<?php

namespace Brain\Cell\Tests\Mock\Association;

use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\AbstractResource;

class SimpleResourceAssociationMock extends AbstractResource
{

    /** @var int */
    protected $id;

    /** @var SimpleResourceMock */
    protected $association;

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
    public function getAssociatedResources()
    {
        return [
            'association' => SimpleResourceMock::CLASS
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
     * @return SimpleResourceMock
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * @param SimpleResourceMock $association
     * @return $this
     */
    public function setAssociation(SimpleResourceMock $association)
    {
        $this->association = $association;
        return $this;
    }

}
