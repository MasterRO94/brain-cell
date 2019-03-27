<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\EntityResource\Stock\Finishing\FinishingCategoryResourceInterface;
use Brain\Cell\EntityResource\Stock\Finishing\FinishingItemResourceInterface;
use Brain\Cell\TransferEntityInterface;

/**
 * A job component level option.
 */
interface JobComponentOptionResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface
{
    /**
     * Return the finishing category.
     */
    public function getFinishingCategory(): FinishingCategoryResourceInterface;

    /**
     * Return the finishing item.
     */
    public function getFinishingItem(): FinishingItemResourceInterface;

    /**
     * Return the finishing configuration.
     *
     * @return mixed[]
     */
    public function getConfiguration(): array;
}
