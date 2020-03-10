<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Product;

use Brain\Cell\EntityResource\TwoDimensionalResource;
use Brain\Cell\Logical\Dimension\TwoDimensionalInterface;
use Brain\Cell\Transfer\AbstractResource;

class ProductCustomSizeRangeResource extends AbstractResource
{
    /** @var TwoDimensionalInterface */
    protected $minimum;

    /** @var TwoDimensionalInterface */
    protected $maximum;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'minimum' => TwoDimensionalResource::class,
            'maximum' => TwoDimensionalResource::class,
        ];
    }

    public function getMinimum(): TwoDimensionalInterface
    {
        return $this->minimum;
    }

    public function setMinimum(TwoDimensionalInterface $minimum): void
    {
        $this->minimum = $minimum;
    }

    public function getMaximum(): TwoDimensionalInterface
    {
        return $this->maximum;
    }

    public function setMaximum(TwoDimensionalInterface $maximum): void
    {
        $this->maximum = $maximum;
    }
}
