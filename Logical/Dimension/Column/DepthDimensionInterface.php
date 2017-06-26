<?php

namespace Brain\Cell\Logical\Dimension\Column;

/**
 * An interface defining a way to get a depth measurement.
 */
interface DepthDimensionInterface
{
    /**
     * Return the depth in millimeters (mm).
     *
     * @return int
     */
    public function getDepth();
}
