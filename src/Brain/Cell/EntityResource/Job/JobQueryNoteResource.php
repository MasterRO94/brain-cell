<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\AbstractNoteResource;
use Brain\Cell\EntityResource\ClientResource;
use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\File\FileResource;

class JobQueryNoteResource extends AbstractNoteResource
{
    public const CANONICAL_GENERIC = 'job_query_note.canonical.generic';
    public const CANONICAL_CREATION = 'job_query_note.canonical.creation';
    public const CANONICAL_RESOLUTION = 'job_query_note.canonical.resolution';

    /** @var FileResource|null */
    protected $file;

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

    public function getFile(): ?FileResource
    {
        return $this->file;
    }

    public function setFile(?FileResource $file): void
    {
        $this->file = $file;
    }
}
