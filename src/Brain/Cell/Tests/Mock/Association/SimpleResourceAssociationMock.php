<?php

declare(strict_types=1);

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
     * @return static
     */
    public static function create(int $id)
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

    public function getId(): int
    {
        return $this->id;
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
