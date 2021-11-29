<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\TransferEntityInterface;

interface JobQueryNoteSuggestionResourceInterface extends
    ResourceIdentityInterface,
    TransferEntityInterface
{
    public function getCanonical(): string;

    public function getReadable(): string;

    public function getDescription(): string;
}
