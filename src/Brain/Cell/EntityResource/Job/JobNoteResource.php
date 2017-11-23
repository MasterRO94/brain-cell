<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\AbstractNoteResource;

/**
 * {@inheritdoc}
 */
class JobNoteResource extends AbstractNoteResource
{
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
}
