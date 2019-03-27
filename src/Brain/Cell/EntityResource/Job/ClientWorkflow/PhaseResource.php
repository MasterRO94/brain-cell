<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job\ClientWorkflow;

use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\DeletedAtTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

class PhaseResource extends AbstractResource implements ResourceIdentityInterface
{
    use ResourceIdentityTrait;
    use CreatedAtTrait;
    use DeletedAtTrait;

    /** @var string */
    protected $canonical;

    /** @var string */
    protected $readable;

    /** @var bool */
    protected $isEntryPoint;

    /** @var ResourceCollection|TransitionResource[] */
    protected $transitions;

    /** @var ClientWorkflowResource */
    protected $clientWorkflow;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'clientWorkflow' => ClientWorkflowResource::class,
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
            'transitions' => TransitionResource::class,
        ];
    }

    /**
     * Return the canonical status string.
     */
    public function getCanonical(): string
    {
        return $this->canonical;
    }

    /**
     * Set the canonical status string.
     */
    public function setCanonical(string $canonical): void
    {
        $this->canonical = $canonical;
    }

    /**
     * Return the localised translation.
     */
    public function getReadable(): string
    {
        return $this->readable;
    }

    public function setReadable(string $readable): void
    {
        $this->readable = $readable;
    }

    public function isIsEntryPoint(): bool
    {
        return $this->isEntryPoint;
    }

    public function setIsEntryPoint(bool $isEntryPoint): void
    {
        $this->isEntryPoint = $isEntryPoint;
    }

    /**
     * @return ResourceCollection|TransitionResource[]
     */
    public function getTransitions()
    {
        return $this->transitions;
    }

    /**
     * @param ResourceCollection|TransitionResource[] $transitions
     */
    public function setTransitions($transitions): void
    {
        $this->transitions = $transitions;
    }

    public function getClientWorkflow(): ClientWorkflowResource
    {
        return $this->clientWorkflow;
    }

    public function setClientWorkflow(ClientWorkflowResource $clientWorkflow): void
    {
        $this->clientWorkflow = $clientWorkflow;
    }
}
