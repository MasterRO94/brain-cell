<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Production;

use Brain\Cell\EntityResource\Common\AbstractStatusResource;
use Brain\Cell\EntityResource\Job\JobResourceInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\TransferEntityInterface;

/**
 * A production resource.
 */
interface ProductionResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface
{
    /**
     * Return the current status.
     */
    public function getStatus(): AbstractStatusResource;

    /**
     * Return the job being produced.
     */
    public function getJob(): JobResourceInterface;
}
