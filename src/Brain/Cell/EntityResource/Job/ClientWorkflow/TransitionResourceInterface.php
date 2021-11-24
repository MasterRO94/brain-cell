<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job\ClientWorkflow;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\Prototype\Column\Date\CreatedAtInterface;
use Brain\Cell\Prototype\Column\Date\UpdatedAtInterface;

interface TransitionResourceInterface extends
    ResourceIdentityInterface,
    CreatedAtInterface,
    UpdatedAtInterface
{
    public function getFrom(): PhaseResource;

    public function getTo(): PhaseResource;
}
