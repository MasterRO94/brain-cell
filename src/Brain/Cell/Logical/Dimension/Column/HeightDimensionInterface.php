<?php

namespace Brain\Cell\Logical\Dimension\Column;

/**
 * An interface defining a way to get a height measurement.
 */
interface HeightDimensionInterface
{
    /**
     * Return the height in millimeters (mm).
     *
     * @return int
     */
    public function getHeight();
}
