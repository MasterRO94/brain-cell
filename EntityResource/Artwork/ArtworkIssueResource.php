<?php

namespace Brain\Cell\EntityResource\Artwork;

use Brain\Cell\EntityResource\AbstractNoteResource;

class ArtworkIssueResource extends AbstractNoteResource
{
    /**
     * @var string
     */
    protected $canonical;

    /**
     * @return string
     */
    public function getCanonical()
    {
        return $this->canonical;
    }

    /**
     * @param string $canonical
     */
    public function setCanonical(string $canonical)
    {
        $this->canonical = $canonical;
    }
}
