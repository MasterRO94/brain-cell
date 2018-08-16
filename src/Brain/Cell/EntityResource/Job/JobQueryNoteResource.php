<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\AbstractNoteResource;
use Brain\Cell\EntityResource\Artwork\ArtworkResource;

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
