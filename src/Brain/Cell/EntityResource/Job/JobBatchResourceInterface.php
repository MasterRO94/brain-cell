<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\TransferEntityInterface;

/**
 * A job batch.
 */
interface JobBatchResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface
{

}
