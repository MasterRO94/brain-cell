<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\AbstractNoteResource;

/**
 * {@inheritdoc}
 */
class JobNoteResource extends AbstractNoteResource
{
    const JOB_NOTE_CANONICAL_GENERIC = 'generic';
    const JOB_NOTE_CANONICAL_QUERY = 'query';

    /**
     * @var string
     */
    protected $summary;

    /**
     * @return string
     */
    public function getSummary()
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
     * @return bool
     */
    public function isQuery()
    {
        return $this->canonical === self::JOB_NOTE_CANONICAL_QUERY;
    }

    /**
     * @return bool
     */
    public function isGeneric()
    {
        return $this->canonical === self::JOB_NOTE_CANONICAL_GENERIC;
    }
}
