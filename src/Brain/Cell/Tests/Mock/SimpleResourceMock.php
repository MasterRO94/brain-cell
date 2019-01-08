<?php

declare(strict_types=1);

namespace Brain\Cell\Tests\Mock;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Transfer\AbstractResource;

/**
 * @internal For mocking only.
 */
final class SimpleResourceMock extends AbstractResource
{
    use ResourceIdentityTrait;

    /** @var string */
    protected $name;

    /**
     * @return static
     */
    public static function create(string $id, string $name)
    {
        $instance = new static();
        $instance->id = $id;
        $instance->name = $name;

        return $instance;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
