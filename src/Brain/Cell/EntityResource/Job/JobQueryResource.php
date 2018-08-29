<?php

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

    /**
     * @var DateResource $resolved
     */
    protected $resolved;

    /**
     * @var DateResource $progressStarted
     */
    protected $progressStarted;

    /**
     * @var ClientResource $assignee
     */
    protected $assignee;

    /**
     * @var string
     */
    protected $summary;

    /**
     * @var JobQueryNoteResource[]|ResourceCollection
     */
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
            'progressStarted'  => DateResource::class,
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

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @param string $summary
     */
    public function setSummary(string $summary)
    {
        $this->summary = $summary;
    }

    /**
     * @return DateResource|null
     */
    public function getResolved(): ?DateResource
    {
        return $this->resolved;
    }

    /**
     * @param DateResource|null $resolved
     */
    public function setResolved(?DateResource $resolved)
    {
        $this->resolved = $resolved;
    }

    /**
     * @return DateResource|null
     */
    public function getProgressStarted(): ?DateResource
    {
        return $this->progressStarted;
    }

    /**
     * @param DateResource|null $progressStarted
     */
    public function setProgressStarted(?DateResource $progressStarted)
    {
        $this->progressStarted = $progressStarted;
    }

    /**
     * @return ClientResource
     */
    public function getAssignee(): ClientResource
    {
        return $this->assignee;
    }

    /**
     * @param ClientResource $assignee
     */
    public function setAssignee(ClientResource $assignee)
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
    public function setNotes(ResourceCollection $notes)
    {
        $this->notes = $notes;
    }
}
