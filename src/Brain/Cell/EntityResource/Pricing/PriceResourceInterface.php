<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Pricing;

use Brain\Cell\TransferEntityInterface;

/**
 * A price.
 */
interface PriceResourceInterface extends
    TransferEntityInterface
{
    /**
     * Return the price value in its base form for the currency.
     *
     * @example 1000 in GBP is £10.00 or 1000p
     */
    public function getBase(): int;

    /**
     * Return the value a float, to preserve the value its wrapped in a string.
     *
     * It's recommend that you use the base value instead and convert it to the form you want.
     * However this means you need to understand all the currencies.
     */
    public function getValue(): string;

    /**
     * Return the price value formatted for the currency.
     */
    public function getFormatted(): string;

    /**
     * Return the current ISO-3 code.
     */
    public function getCurrency(): string;
}
