<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Country;

use Brain\Cell\TransferEntityInterface;

/**
 * A country.
 */
interface CountryResourceInterface extends
    TransferEntityInterface
{
    public function getName(): string;

    public function getIso(): string;

    public function getIso3(): string;
}
