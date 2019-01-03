<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\TransferEntityInterface;

/**
 * A print job.
 */
interface JobResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface
{
    /**
     * The shorthand hash of the Job.
     * This will be NULL on non-persisted entities.
     */
    public function getHash(): ?string;
}
