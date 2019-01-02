<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job\ClientWorkflow;

use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Interfaces\ResourcePublicIdInterface;
use Brain\Cell\EntityResource\Job\JobStatusResource;
use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

class ClientWorkflowResource extends AbstractResource implements ResourcePublicIdInterface
{
    use ResourcePublicIdTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;

    /** @var JobStatusResource */
    protected $status;

    /** @var PhaseResource[]|ResourceCollection */
    protected $phases;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'status' => JobStatusResource::class,
            'createdAt' => DateResource::class,
            'updatedAt' => DateResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections(): array
    {
        return [
            'phases' => PhaseResource::class,
        ];
    }

    public function getStatus(): JobStatusResource
    {
        return $this->status;
    }

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
