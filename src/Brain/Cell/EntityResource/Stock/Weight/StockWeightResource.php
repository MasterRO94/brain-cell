<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Stock\Weight;

use Brain\Cell\Transfer\AbstractResource;

final class StockWeightResource extends AbstractResource
{
    /** @var float */
    protected $value;

    /** @var string */
    protected $unit;

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): void
    {
        $this->unit = $unit;
    }
}