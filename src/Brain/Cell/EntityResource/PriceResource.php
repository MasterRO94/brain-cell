<?php

namespace Brain\Cell\EntityResource;

use Brain\Cell\Transfer\AbstractResource;

class PriceResource extends AbstractResource
{
    /**
     * @var int $base
     */
    protected $base;

    /**
     * @var float $value
     */
    protected $value;

    /**
     * @var string $formatted
     */
    protected $formatted;

    /**
     * @var string $currency
     */
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
    public function setBase($base)
    {
        $this->base = $base;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getFormatted()
    {
        return $this->formatted;
    }

    /**
     * @param string $formatted
     */
    public function setFormatted($formatted)
    {
        $this->formatted = $formatted;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }
}
