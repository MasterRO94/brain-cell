<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Common\Weight;

use Brain\Cell\Transfer\AbstractResource;

/**
 * A weight.
 */
final class WeightResource extends AbstractResource implements
    WeightResourceInterface
{
    /** @var int */
    private $value = 0;

    /** @var string */
    private $unit = WeightResourceInterface::UNIT_GRAMS;

    /**
     * {@inheritdoc}
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function getUnit(): string
    {
        return $this->unit;
    }
}
