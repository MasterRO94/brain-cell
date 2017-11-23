<?php

namespace Brain\Cell\Tests\Mock\Association;

use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\AbstractResource;

class SimpleResourceAssociationMock extends AbstractResource
{

    /** @var int */
    protected $id;

    /** @var SimpleResourceMock */
    protected $associatedResource;

    /**
     * @param int $id
     * @return static
     */
    public static function create($id)
    {
        $instance = new static;
        $instance->id = $id;
        return $instance;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'associatedResource' => SimpleResourceMock::CLASS
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
     * @return SimpleResourceMock
     */
    public function getAssociatedResource()
    {
        return $this->associatedResource;
    }

    /**
     * @param SimpleResourceMock $associatedResource
     * @return $this
     */
    public function setAssociatedResource(SimpleResourceMock $associatedResource)
    {
        $this->associatedResource = $associatedResource;
        return $this;
    }

}
