<?php

namespace Brain\Cell\EntityResource\Job\ClientWorkflow;

use Brain\Cell\EntityResource\Job\ClientWorkflow\PhaseResource;
use Brain\Cell\EntityResource\Job\ClientWorkflow\TransitionResourceInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\Prototype\Column\Date\CreatedAtInterface;
use Brain\Cell\Prototype\Column\Date\UpdatedAtInterface;
use Brain\Cell\Transfer\ResourceCollection;

interface ClientWorkflowResourceInterface extends
    ResourceIdentityInterface,
    CreatedAtInterface,
    UpdatedAtInterface
{
    /**
     * @return JobStatusResource
     */
    public function getStatus(): JobStatusResource;

    /**
     * @return PhaseResource[]|ResourceCollection
     */
    public function getPhases(): ResourceCollection;


    /**
     * @return TransitionResourceInterface[]|ResourceCollection
     */
    public function getTransitions(): ResourceCollection;
}
