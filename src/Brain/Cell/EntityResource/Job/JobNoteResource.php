<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\AbstractNoteResource;

/**
 * {@inheritdoc}
 */
class JobNoteResource extends AbstractNoteResource
{
    const JOB_NOTE_CANONICAL = 'job_note';
    const JOB_NOTE_QUERY_CANONICAL = 'job_query';
    const JOB_NOTE_QUERY_RESOLUTION_CANONICAL = 'job_query_resolution';

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
        return $this->canonical === self::JOB_NOTE_QUERY_CANONICAL;
    }

    /**
     * @return bool
     */
    public function isQueryResolution()
    {
        return $this->canonical === self::JOB_NOTE_QUERY_RESOLUTION_CANONICAL;
    }

    /**
     * @return bool
     */
    public function isGeneral()
    {
        return $this->canonical === self::JOB_NOTE_CANONICAL;
    }
}
