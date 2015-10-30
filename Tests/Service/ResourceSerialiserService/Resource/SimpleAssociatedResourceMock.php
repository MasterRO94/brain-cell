<?php

namespace Brain\Cell\Tests\Service\ResourceSerialiserService\Resource;

use Brain\Cell\Transfer\AbstractResource;

class SimpleAssociatedResourceMock extends AbstractResource
{

    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var SimpleResourceMock */
    protected $association;

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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return SimpleResourceMock
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @param SimpleResourceMock|AbstractResource $association
     * @return SimpleAssociatedResourceMock
     */
    public function setAssociation(AbstractResource $association)
    {
        $this->association = $association;
        return $this;
    }

}
