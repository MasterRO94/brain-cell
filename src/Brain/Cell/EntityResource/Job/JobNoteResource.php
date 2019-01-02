<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\AbstractNoteResource;

/**
 * {@inheritdoc}
 */
class JobNoteResource extends AbstractNoteResource
{
    public const JOB_NOTE_CANONICAL_GENERIC = 'generic';
    public const JOB_NOTE_CANONICAL_QUERY = 'query';

    /** @var string */
    protected $summary;

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): void
    {
        $this->summary = $summary;
    }

    public function isQuery(): bool
    {
        return $this->canonical === self::JOB_NOTE_CANONICAL_QUERY;
    }

    public function isGeneric(): bool
    {
        return $this->canonical === self::JOB_NOTE_CANONICAL_GENERIC;
    }
}
