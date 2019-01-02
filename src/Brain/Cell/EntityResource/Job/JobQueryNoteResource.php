<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\AbstractNoteResource;
use Brain\Cell\EntityResource\Artwork\ArtworkResource;
use Brain\Cell\EntityResource\ClientResource;
use Brain\Cell\EntityResource\Common\DateResource;

class JobQueryNoteResource extends AbstractNoteResource
{
    const CANONICAL_GENERIC = 'job_query_note.canonical.generic';
    const CANONICAL_CREATION = 'job_query_note.canonical.creation';
    const CANONICAL_RESOLUTION = 'job_query_note.canonical.resolution';

    /**
     * @var ArtworkResource
     */
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

    /**
     * @return ArtworkResource
     */
    public function getArtwork(): ArtworkResource
    {
        return $this->artwork;
    }

    /**
     * @param ArtworkResource $artwork
     */
    public function setArtwork(ArtworkResource $artwork)
    {
        $this->artwork = $artwork;
    }
}
