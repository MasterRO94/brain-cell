<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource;

use Brain\Cell\Logical\Dimension\ThreeDimensionalInterface;
use Brain\Cell\Transfer\AbstractResource;

class ThreeDimensionalResource extends AbstractResource implements
    ThreeDimensionalInterface
{
    /** @var int */
    protected $width;

    /** @var int */
    protected $height;

    /** @var int */
    protected $depth;

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

    /**
     * {@inheritdoc}
     */
    public function getDepth(): int
    {
        return $this->depth;
    }

    public function setDepth(int $depth): void
    {
        $this->depth = $depth;
    }
}
