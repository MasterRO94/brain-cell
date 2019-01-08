<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Stock\Finishing;

use Brain\Cell\EntityResource\Prototype\ResourceAliasInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\TransferEntityInterface;

/**
 * A finishing item.
 */
interface FinishingItemResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface,
    ResourceAliasInterface
{
    /**
     * Return the human-readable name.
     */
    public function getName(): string;

    /**
     * Check if the finishing is the default for its category.
     */
    public function isDefault(): bool;

    /**
     * Check if the finishing is configurable.
     */
    public function isConfigurable(): bool;

    /**
     * Return the default finishing configuration.
     *
     * @return mixed[]
     */
    public function getConfiguration(): array;
}
