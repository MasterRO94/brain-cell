<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Product;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\TransferEntityInterface;

/**
 * A product grouping.
 */
interface ProductGroupResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface
{
    /**
     * The product group name defined by the client.
     */
    public function getName(): string;
}
