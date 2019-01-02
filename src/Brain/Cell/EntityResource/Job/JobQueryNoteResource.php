<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\AbstractNoteResource;
use Brain\Cell\EntityResource\Artwork\ArtworkResource;
use Brain\Cell\EntityResource\ClientResource;
use Brain\Cell\EntityResource\Common\DateResource;

class JobQueryNoteResource extends AbstractNoteResource
{
    public const CANONICAL_GENERIC = 'job_query_note.canonical.generic';
    public const CANONICAL_CREATION = 'job_query_note.canonical.creation';
    public const CANONICAL_RESOLUTION = 'job_query_note.canonical.resolution';

    /** @var ArtworkResource */
    protected $artwork;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'artwork' => ArtworkResource::class,
            'origin' => ClientResource::class,
            'createdAt' => DateResource::class,
            'updatedAt' => DateResource::class,
        ];
    }

    public function getArtwork(): ArtworkResource
    {
        return $this->artwork;
    }

    public function setArtwork(ArtworkResource $artwork): void
    {
        $this->artwork = $artwork;
    }
}
