<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Stock;

use Brain\Cell\EntityResource\Prototype\ResourceAliasInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\EntityResource\Stock\Material\MaterialBaseResourceInterface;
use Brain\Cell\EntityResource\Stock\Material\MaterialVariantResourceInterface;
use Brain\Cell\EntityResource\Stock\Material\MaterialWeightResourceInterface;
use Brain\Cell\TransferEntityInterface;

interface MaterialResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface,
    ResourceAliasInterface
{
    /**
     * Return the human-readable name.
     */
    public function getName(): string;

    public function getBase(): MaterialBaseResourceInterface;

    public function getVariant(): MaterialVariantResourceInterface;

    public function getWeight(): MaterialWeightResourceInterface;
}
