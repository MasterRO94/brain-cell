<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Product;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\TransferEntityInterface;

/**
 * A product.
 */
interface ProductResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface
{
    /**
     * The product name defined by the client.
     */
    public function getName(): string;

    /**
     * Whether the Product allows custom sizes to be selected.
     */
    public function isAllowedCustomSizes(): bool;

    /**
     * The custom size range dimensions.
     */
    public function getCustomSizeRange(): ?ProductCustomSizeRangeResource;
}
