<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\ClientResource;
use Brain\Cell\EntityResource\Common\DateResourceInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;

interface JobQueryResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface
{
    public function getSummary(): JobQuerySummaryResourceInterface;

    public function getResolved(): ?DateResourceInterface;

    public function getProgressStarted(): ?DateResourceInterface;

    public function getAssignee(): ClientResource;

    /**
     * @return JobQueryNoteResource[]|ResourceCollection
     */
    public function getNotes(): ResourceCollection;
}
