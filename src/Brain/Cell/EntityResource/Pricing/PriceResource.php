<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Pricing;

use Brain\Cell\Transfer\AbstractResource;

/**
 * A price.
 */
final class PriceResource extends AbstractResource implements
    PriceResourceInterface
{
    /** @var int */
    private $base;

    /** @var string */
    private $value;

    /** @var string */
    private $formatted;

    /** @var string */
    private $currency;

    /**
     * {@inheritdoc}
     */
    public function getBase(): int
    {
        return $this->base;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function getFormatted(): string
    {
        return $this->formatted;
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }
}
