<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Stock\Material;

use Brain\Cell\EntityResource\Prototype\ResourceAliasTrait;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Transfer\AbstractResource;

/**
 * A material base.
 */
class MaterialBaseResource extends AbstractResource implements
    MaterialBaseResourceInterface
{
    use ResourceIdentityTrait;
    use ResourceAliasTrait;

    /** @var string */
    protected $name;

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @deprecated This should not be used, if you are using it for tests mock the interface.
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
