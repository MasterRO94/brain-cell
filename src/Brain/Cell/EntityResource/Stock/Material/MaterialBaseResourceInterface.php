<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Stock\Material;

use Brain\Cell\EntityResource\Prototype\ResourceAliasInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\TransferEntityInterface;

/**
 * A material base.
 */
interface MaterialBaseResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface,
    ResourceAliasInterface
{
    /**
     * Return the human-readable name.
     */
    public function getName(): string;
}
