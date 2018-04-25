<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\ClientResource;
use Brain\Cell\EntityResource\Interfaces\ResourcePublicIdInterface;
use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

class JobQueryResource extends AbstractResource implements ResourcePublicIdInterface
{
    use ResourcePublicIdTrait;

    /**
     * @var \DateTime $created
     */
    protected $created;

    /**
     * @var \DateTime $updated
     */
    protected $updated;

    /**
     * @var \DateTime $resolved
     */
    protected $resolved;

    /**
     * @var \DateTime $progressStarted
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
    public function getAssociatedCollections()
    {
        return [
            'notes' => JobQueryNoteResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'assignee' => ClientResource::class,
        ];
    }

    public function getDateTimeProperties()
    {
        return [
            'created',
            'updated',
            'resolved',
            'progressStarted',
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
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated(): \DateTime
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     */
    public function setUpdated(\DateTime $updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return \DateTime|null
     */
    public function getResolved(): ?\DateTime
    {
        return $this->resolved;
    }

    /**
     * @param \DateTime|null $resolved
     */
    public function setResolved(?\DateTime $resolved)
    {
        $this->resolved = $resolved;
    }

    /**
     * @return \DateTime|null
     */
    public function getProgressStarted(): ?\DateTime
    {
        return $this->progressStarted;
    }

    /**
     * @param \DateTime|null $progressStarted
     */
    public function setProgressStarted(?\DateTime $progressStarted)
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
