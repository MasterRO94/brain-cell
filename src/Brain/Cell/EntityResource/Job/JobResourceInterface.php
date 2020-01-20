<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Common\Weight\WeightResourceInterface;
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
     * @todo more general implementation
     *
     * @see https://projects.printed.systems/browse/BRN-742
     */
    public const PREFLIGHT_FAILURE_POLICY_FIX = 'job.preflight_failure_policy.fix';
    public const PREFLIGHT_FAILURE_POLICY_CANCEL = 'job.preflight_failure_policy.cancel';
    public const PREFLIGHT_FAILURE_POLICY_IGNORE = 'job.preflight_failure_policy.ignore';

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

    public function getGroup(): ?JobGroupResourceInterface;

    public function getIndex(): ?int;

    /**
     * Return the quantity of this job to be produced.
     */
    public function getQuantity(): int;

    /**
     * Return the job weight resource.
     */
    public function getWeight(): WeightResourceInterface;

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

    /**
     * Return the job meta.
     */
    public function getMeta(): ?JobMetaResourceInterface;

    /**
     * @return JobStatusResource[]|ResourceCollection
     */
    public function getStatuses(): ResourceCollection;
}
