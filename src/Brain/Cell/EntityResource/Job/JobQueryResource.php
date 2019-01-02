<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\ClientResource;
use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Interfaces\ResourcePublicIdInterface;
use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

class JobQueryResource extends AbstractResource implements ResourcePublicIdInterface
{
    use ResourcePublicIdTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;

    /** @var DateResource $resolved */
    protected $resolved;

    /** @var DateResource $progressStarted */
    protected $progressStarted;

    /** @var ClientResource $assignee */
    protected $assignee;

    /** @var string */
    protected $summary;

    /** @var JobQueryNoteResource[]|ResourceCollection */
    protected $notes;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'assignee' => ClientResource::class,
            'createdAt' => DateResource::class,
            'updatedAt' => DateResource::class,
            'progressStarted' => DateResource::class,
            'resolved' => DateResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections(): array
    {
        return [
            'notes' => JobQueryNoteResource::class,
        ];
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): void
    {
        $this->summary = $summary;
    }

    public function getResolved(): ?DateResource
    {
        return $this->resolved;
    }

    public function setResolved(?DateResource $resolved): void
    {
        $this->resolved = $resolved;
    }

    public function getProgressStarted(): ?DateResource
    {
        return $this->progressStarted;
    }

    public function setProgressStarted(?DateResource $progressStarted): void
    {
        $this->progressStarted = $progressStarted;
    }

    public function getAssignee(): ClientResource
    {
        return $this->assignee;
    }

    public function setAssignee(ClientResource $assignee): void
    {
        $this->assignee = $assignee;
    }

    /**
     * @return JobQueryNoteResource[]|ResourceCollection
     */
    public function getNotes(): ResourceCollection
    {
        return $this->notes;
    }

    /**
     * @param JobQueryNoteResource[]|ResourceCollection $notes
     */
    public function setNotes(ResourceCollection $notes): void
    {
        $this->notes = $notes;
    }
}
