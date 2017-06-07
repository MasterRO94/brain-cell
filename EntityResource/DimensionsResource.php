<?php
/**
 * @maintainer Alex Moon <alex.moon@printed.com>
 */

namespace Brain\Cell\EntityResource;

use Brain\Cell\Transfer\AbstractResource;

class DimensionsResource extends AbstractResource
{
    /**
     * @var int $width
     */
    protected $width;

    /**
     * @var int $height
     */
    protected $height;

    /**
     * @var int $depth
     */
    protected $depth;

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return DimensionsResource
     */
    public function setWidth(int $width): DimensionsResource
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return DimensionsResource
     */
    public function setHeight(int $height): DimensionsResource
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * @param mixed $depth
     * @return DimensionsResource
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;
        return $this;
    }
}
