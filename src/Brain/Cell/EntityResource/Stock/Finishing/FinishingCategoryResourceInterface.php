<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Stock\Finishing;

use Brain\Cell\EntityResource\Prototype\ResourceAliasInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;

/**
 * A finishing category.
 */
interface FinishingCategoryResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface,
    ResourceAliasInterface
{
    /**
     * Return the human-readable name.
     */
    public function getName(): string;

    /**
     * Return the finishing items that belong to this category.
     *
     * @return FinishingItemResourceInterface[]|ResourceCollection
     */
    public function getOptions(): ResourceCollection;
}
