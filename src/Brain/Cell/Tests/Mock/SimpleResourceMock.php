<?php

declare(strict_types=1);

namespace Brain\Cell\Tests\Mock;

use Brain\Cell\Transfer\AbstractResource;

class SimpleResourceMock extends AbstractResource
{
    /** @var int|null */
    protected $id;

    /** @var string */
    protected $name;

    /**
     * @return static
     */
    public static function create(int $id, string $name)
    {
        $instance = new static();
        $instance->id = $id;
        $instance->name = $name;

        return $instance;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
