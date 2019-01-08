<?php

declare(strict_types=1);

namespace Brain\Cell\Tests\Mock\Association;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\AbstractResource;

/**
 * @internal For mocking only.
 */
final class SimpleResourceAssociationMock extends AbstractResource
{
    use ResourceIdentityTrait;

    /** @var SimpleResourceMock */
    protected $associatedResource;

    public static function create(string $id): SimpleResourceAssociationMock
    {
        $instance = new static();
        $instance->id = $id;

        return $instance;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'associatedResource' => SimpleResourceMock::class,
        ];
    }

    public function getAssociatedResource(): SimpleResourceMock
    {
        return $this->associatedResource;
    }

    /**
     * @return $this
     */
    public function setAssociatedResource(SimpleResourceMock $associatedResource)
    {
        $this->associatedResource = $associatedResource;

        return $this;
    }
}
