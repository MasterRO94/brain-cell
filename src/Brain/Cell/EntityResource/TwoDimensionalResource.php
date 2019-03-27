<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource;

use Brain\Cell\Logical\Dimension\TwoDimensionalInterface;
use Brain\Cell\Transfer\AbstractResource;

class TwoDimensionalResource extends AbstractResource implements
    TwoDimensionalInterface
{
    /** @var int */
    protected $width;

    /** @var int */
    protected $height;

    /**
     * {@inheritdoc}
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): void
    {
        $this->height = $height;
    }
}
