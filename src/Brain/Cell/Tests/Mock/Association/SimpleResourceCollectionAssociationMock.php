<?php

declare(strict_types=1);

namespace Brain\Cell\Tests\Mock\Association;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

/**
 * @internal For mocking only.
 */
final class SimpleResourceCollectionAssociationMock extends AbstractResource
{
    use ResourceIdentityTrait;

    /** @var ResourceCollection|SimpleResourceMock[] */
    protected $associatedCollection;

    public static function create(string $id): SimpleResourceCollectionAssociationMock
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
