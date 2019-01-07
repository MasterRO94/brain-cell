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
}
