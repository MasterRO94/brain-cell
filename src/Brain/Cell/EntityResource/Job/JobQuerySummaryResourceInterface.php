<?php

namespace Brain\Cell\EntityResource\Job;

interface JobQuerySummaryResourceInterface extends ResourceIdentityInterface
{
    public function getCanonical(): string;
    public function getReadable(): string;
    public function getDescription(): ?string;
    public function getIsExternal(): bool;
}
