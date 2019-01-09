<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Product\ProductResourceInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;

/**
 * A job.
 */
interface JobResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface
{
    /**
     * The shorthand hash of the Job.
     *
     * Note; this will be NULL on non-persisted entities.
     */
    public function getHash(): ?string;

    /**
     * The client reference.
     */
    public function getReference(): string;

    /**
     * Return the product.
     *
     * Note; this will be NULL in cases where the job is a bespoke product.
     */
    public function getProduct(): ?ProductResourceInterface;

    /**
     * Return the job batch.
     *
     * Note; this will be NULL in cases where the job is in a status considered lower than READY.
     */
    public function getBatch(): ?JobBatchResourceInterface;

    /**
     * Return the quantity of this job to be produced.
     */
    public function getQuantity(): int;

    /**
     * Return the job components.
     *
     * @return ResourceCollection|JobComponentResourceInterface[]
     */
    public function getComponents(): ResourceCollection;

    /**
     * Return the job level options.
     *
     * @return ResourceCollection|JobOptionResourceInterface[]
     */
    public function getOptions(): ResourceCollection;
}