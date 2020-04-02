<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;

/**
 * A job batch.
 */
interface JobGroupResourceInterface extends
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
     * Return the jobs in the batch.
     *
     * @return JobResourceInterface[]|ResourceCollection
     */
    public function getJobs(): ResourceCollection;

    public function setJobs($jobs): void;
}
