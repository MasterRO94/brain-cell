<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Delivery\DeliveryOptionResourceInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\Prototype\Column\Date\CreatedAtInterface;
use Brain\Cell\Prototype\Column\Date\UpdatedAtInterface;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;

/**
 * A job batch.
 */
interface JobBatchResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface,
    CreatedAtInterface,
    UpdatedAtInterface
{
    /**
     * Return the batch delivery option.
     *
     * Note; this can be NULL in cases where a batch has no delivery information yet.
     */
    public function getDeliveryOption(): ?DeliveryOptionResourceInterface;

    /**
     * Return the jobs in the batch.
     *
     * @return JobResourceInterface[]|ResourceCollection
     */
    public function getJobs(): ResourceCollection;

    /**
     * Return the batch delivery details.
     */
    public function getBatchDelivery(): ?JobBatchBatchDeliveryResourceInterface;
}
