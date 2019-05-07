<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Stock;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\TransferEntityInterface;

/**
 * A stock definition.
 */
interface StockDefinitionResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface
{
    /**
     * The stock definition name defined by the client.
     */
    public function getName(): string;
}
