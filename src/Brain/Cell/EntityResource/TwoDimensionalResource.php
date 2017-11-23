<?php

namespace Brain\Cell\EntityResource;

use Brain\Cell\Logical\Dimension\TwoDimensionalInterface;
use Brain\Cell\Transfer\AbstractResource;

class TwoDimensionalResource extends AbstractResource implements TwoDimensionalInterface
{
    /**
     * @var int
     */
    protected $width;

    /**
     * @var int
     */
    protected $height;

    /**
     * {@inheritdoc}
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     *
     * @return TwoDimensionalResource
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     *
     * @return TwoDimensionalResource
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }
}
