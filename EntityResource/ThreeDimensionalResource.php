<?php

namespace Brain\Cell\EntityResource;

use Brain\Cell\Logical\Dimension\ThreeDimensionalInterface;
use Brain\Cell\Transfer\AbstractResource;

class ThreeDimensionalResource extends AbstractResource implements ThreeDimensionalInterface
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
     * @var int
     */
    protected $depth;

    /**
     * @param int $width
     * @param int $height
     * @param int $depth
     */
    public function __construct($width, $height, $depth)
    {
        $this->width = $width;
        $this->height = $height;
        $this->depth = $depth;
    }

    /**
     * {@inheritdoc}
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return ThreeDimensionalResource
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
     * @return ThreeDimensionalResource
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * @param int $depth
     * @return ThreeDimensionalResource
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;

        return $this;
    }
}
