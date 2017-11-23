<?php

namespace Brain\Cell\Logical\Dimension;

use Brain\Cell\Logical\Dimension\Column\HeightDimensionInterface;
use Brain\Cell\Logical\Dimension\Column\WidthDimensionInterface;

/**
 * Representing a two dimensional object.
 *
 * Our standard two dimensional object contains a width and height. An example being a sheet or paper size in 2D space.
 */
interface TwoDimensionalInterface extends
    DimensionInterface,
    WidthDimensionInterface,
    HeightDimensionInterface
{
}
