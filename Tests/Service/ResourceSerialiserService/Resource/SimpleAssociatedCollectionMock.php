<?php

namespace Brain\Cell\Tests\Service\ResourceSerialiserService\Resource;

use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\Meta\MetaResourceCollection;

class SimpleAssociatedCollectionMock extends AbstractResource
{

    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var SimpleResourceCollectionMock */
    protected $associations;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'associations' => SimpleResourceCollectionMock::CLASS
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
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return SimpleResourceCollectionMock
     */
    public function getAssociations()
    {
        return $this->associations;
    }

    /**
     * @param SimpleResourceCollectionMock|MetaResourceCollection $associations
     * @return $this
     */
    public function setAssociations($associations)
    {
        $this->associations = $associations;
        return $this;
    }



}
