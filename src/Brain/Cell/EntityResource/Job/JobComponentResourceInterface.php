<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\EntityResource\Stock\MaterialResourceInterface;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;

/**
 * A job component.
 */
interface JobComponentResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface
{
    public function getRangeStart(): int;
    public function getRangeEnd(): int;

    public function getMaterial(): MaterialResourceInterface;

    /**
     * Return the job component level options.
     *
     * @return ResourceCollection|JobComponentOptionResourceInterface[]
     */
    public function getOptions(): ResourceCollection;
}
