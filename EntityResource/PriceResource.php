<?php
/**
 * @maintainer Alex Moon <alex.moon@printed.com>
 */

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
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue(float $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getFormatted(): string
    {
        return $this->formatted;
    }

    /**
     * @param string $formatted
     */
    public function setFormatted(string $formatted)
    {
        $this->formatted = $formatted;
    }
}
