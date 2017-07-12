<?php

namespace Brain\Cell\Logical\Dimension;

use Brain\Cell\Logical\Dimension\Column\DepthDimensionInterface;
use Brain\Cell\Logical\Dimension\Column\HeightDimensionInterface;
use Brain\Cell\Logical\Dimension\Column\WidthDimensionInterface;
use Brain\Cell\Logical\Dimension\DimensionInterface;

/**
 * Representing a three dimensional object.
 *
 * Our standard three dimensional object contains width, height and depth dimensions. An example of this could be a box
 * or package in 3D space.
 */
interface ThreeDimensionalInterface extends
    DimensionInterface,
    WidthDimensionInterface,
    HeightDimensionInterface,
    DepthDimensionInterface
{
}
