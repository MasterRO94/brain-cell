<?php

namespace Brain\Cell\Logical\Dimension\Column;

/**
 * An interface defining a way to get a width measurement.
 */
interface WidthDimensionInterface
{
    /**
     * Return the width in millimeters (mm).
     *
     * @return int
     */
    public function getWidth();
}
