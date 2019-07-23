<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Common\Weight;

use Brain\Cell\TransferEntityInterface;

/**
 * A common weight resource.
 */
interface WeightResourceInterface extends
    TransferEntityInterface
{
    public const UNIT_GRAMS = 'grams';

    /**
     * Return the weight value.
     */
    public function getValue(): float;

    /**
     * Return the weight unit.
     */
    public function getUnit(): string;
}
