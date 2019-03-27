<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource;

use Brain\Cell\Transfer\AbstractResource;

class PriceResource extends AbstractResource
{
    /** @var int $base */
    protected $base;

    /** @var float $value */
    protected $value;

    /** @var string $formatted */
    protected $formatted;

    /** @var string $currency */
    protected $currency;

    /**
     * @return mixed
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * @param mixed $base
     */
    public function setBase($base): void
    {
        $this->base = $base;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    public function getFormatted(): string
    {
        return $this->formatted;
    }

    public function setFormatted(string $formatted): void
    {
        $this->formatted = $formatted;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }
}
