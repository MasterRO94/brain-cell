<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job\ClientWorkflow;

use Brain\Cell\EntityResource\ClientResource;
use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Job\ClientWorkflow\ClientWorkflowResourceInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

class ClientWorkflowResource extends AbstractResource implements ClientWorkflowResourceInterface
{
    use ResourceIdentityTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;

    /** @var string */
    protected $status;

    /** @var ClientResource */
    protected $client;

    /** @var PhaseResource[]|ResourceCollection */
    protected $phases;

    /** @var TransitionResourceInterface[]|ResourceCollection */
    protected $transitions;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'client' => ClientResource::class,
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
            'transitions' => TransitionResource::class,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return ClientResource
     */
    public function getClient(): ClientResource
    {
        return $this->client;
    }

    /**
     * @param ClientResource $client
     */
    public function setClient(ClientResource $client): void
    {
        $this->client = $client;
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
    
    /**
     * @return TransitionResourceInterface[]|ResourceCollection
     */
    public function getTransitions(): ResourceCollection
    {
        return $this->transitions;
    }

    /**
     * @param TransitionResourceInterface[]|ResourceCollection $transitions
     */
    public function setTransitions(ResourceCollection $transitions): void
    {
        $this->transitions = $transitions;
    }
}
