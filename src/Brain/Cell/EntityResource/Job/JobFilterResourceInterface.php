<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\Prototype\Column\Date\CreatedAtInterface;
use Brain\Cell\Prototype\Column\Date\UpdatedAtInterface;
use Brain\Cell\TransferEntityInterface;

interface JobFilterResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface,
    CreatedAtInterface,
    UpdatedAtInterface
{
    public function getName(): string;
}
