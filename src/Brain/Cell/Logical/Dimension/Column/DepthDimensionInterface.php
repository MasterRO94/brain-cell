<?php

declare(strict_types=1);

namespace Brain\Cell\Logical\Dimension\Column;

/**
 * An interface defining a way to get a depth measurement.
 */
interface DepthDimensionInterface
{
    /**
     * Return the depth in millimeters (mm).
     */
    public function getDepth(): int;
}
