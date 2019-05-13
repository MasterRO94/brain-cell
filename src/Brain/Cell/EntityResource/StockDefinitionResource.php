<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\EntityResource\Stock\StockDefinitionResourceInterface;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class StockDefinitionResource extends AbstractResource implements
    StockDefinitionResourceInterface
{
    use ResourceIdentityTrait;

    /** @var string */
    protected $name;

    /** @var string */
    protected $type;

    /** @var int */
    protected $width;

    /** @var int */
    protected $height;

    /** @var int */
    protected $stripWidth;

    /** @var int */
    protected $stripQuantity;

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getStripWidth(): int
    {
        return $this->stripWidth;
    }

    public function getStripQuantity(): int
    {
        return $this->stripQuantity;
    }
}
