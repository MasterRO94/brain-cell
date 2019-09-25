<?php

namespace Brain\Cell\EntityResource\Job;

interface JobQueryResourceInterface extends ResourceIdentityInterface
{
    public function getSummary(): JobQuerySummaryResourceInterface;
    public function getResolved(): ?DateResource;
    public function getProgressStarted(): ?DateResource;
    public function getAssignee(): ClientResource;

    /**
     * @return JobQueryNoteResource[]|ResourceCollection
     */
    public function getNotes(): ResourceCollection;
}
