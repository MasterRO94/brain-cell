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
    protected $associatedCollection;

    /**
     * @param int $id
     *
     * @return static
     */
    public static function create($id)
    {
        $instance = new static();
        $instance->id = $id;

        return $instance;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections(): array
    {
        return [
            'associatedCollection' => SimpleResourceMock::class,
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
     * @return ResourceCollection|SimpleResourceMock[]
     */
    public function getAssociatedCollection()
    {
        return $this->associatedCollection;
    }

    /**
     * @param ResourceCollection|SimpleResourceMock[] $associatedCollection
     *
     * @return $this
     */
    public function setAssociatedCollection(ResourceCollection $associatedCollection)
    {
        $this->associatedCollection = $associatedCollection;

        return $this;
    }
}
