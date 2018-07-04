<?php

namespace Brain\Cell\EntityResource\Job\ClientWorkflow;

use Brain\Cell\EntityResource\Traits\ResourceCreatedUpdatedTrait;
use Brain\Cell\EntityResource\Interfaces\ResourcePublicIdInterface;
use Brain\Cell\EntityResource\Job\JobStatusResource;
use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

use Symfony\Component\Validator\Constraints as Assert;

class ClientWorkflowResource extends AbstractResource implements ResourcePublicIdInterface
{
    use ResourcePublicIdTrait;
    use ResourceCreatedUpdatedTrait;

    /**
     * @var JobStatusResource
     */
    protected $status;

    /**
     * @var PhaseResource[]|ResourceCollection
     */
    protected $phases;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'status' => JobStatusResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'phases' => PhaseResource::class,
        ];
    }

    /**
     * @return JobStatusResource
     */
    public function getStatus(): JobStatusResource
    {
        return $this->status;
    }

    /**
     * @param JobStatusResource $status
     */
    public function setStatus(JobStatusResource $status): void
    {
        $this->status = $status;
    }

    /**
     * @return PhaseResource[]|ResourceCollection
     */
    public function getPhases(): ResourceCollection
    {
        return $this->phases;
    }

    /**
     * @param PhaseResource[]|ResourceCollection $phases
     */
    public function setPhases(ResourceCollection $phases): void
    {
        $this->phases = $phases;
    }
}
