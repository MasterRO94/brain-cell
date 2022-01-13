<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\AbstractNoteResource;
use Brain\Cell\EntityResource\ClientResource;
use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\File\FileResource;
use Brain\Cell\EntityResource\File\FileResourceInterface;
use Brain\Cell\Transfer\ResourceCollection;

class JobQueryNoteResource extends AbstractNoteResource
{
    public const CANONICAL_GENERIC = 'job_query_note.canonical.generic';
    public const CANONICAL_CREATION = 'job_query_note.canonical.creation';
    public const CANONICAL_RESOLUTION = 'job_query_note.canonical.resolution';

    /** @var FileResourceInterface|null */
    protected $file;

    /** @var JobQueryNoteSuggestionResourceInterface[]|ResourceCollection */
    protected $createdFromSuggestions;

    public function __construct()
    {
        $this->createdFromSuggestions = new ResourceCollection();
        $this->createdFromSuggestions->setEntityClass(JobQueryNoteSuggestionResource::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'file' => FileResource::class,
            'origin' => ClientResource::class,
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
            'createdFromSuggestions' => JobQueryNoteSuggestionResource::class,
        ];
    }

    public function getFile(): ?FileResourceInterface
    {
        return $this->file;
    }

    public function setFile(?FileResourceInterface $file): void
    {
        $this->file = $file;
    }

    /**
     * @return JobQueryNoteSuggestionResourceInterface[]|ResourceCollection
     */
    public function getNoteSuggestions(): ResourceCollection
    {
        return $this->createdFromSuggestions;
    }

    /**
     * @param JobQueryNoteSuggestionResourceInterface[]|ResourceCollection $noteSuggestions
     */
    public function setNoteSuggestions(ResourceCollection $noteSuggestions): void
    {
        $this->createdFromSuggestions = $noteSuggestions;
    }
}
