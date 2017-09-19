<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\Transfer\AbstractResource;

class JobNoteResource extends AbstractResource
{
    /**
     * @var string
     */
    protected $summary;

    /**
     * @var string
     */
    protected $description;

    //todo this would be helpful
//    /**
//     * @var string
//     */
//    protected $target;

    /**
     * @return string
     */
    public function getSummary(): string
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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    //todo this would be helpful
//    public function getTarget(): ?ClientInterface
//    {
//        return $this->target;
//    }
//
//    public function setTarget(ClientInterface $target)
//    {
//        $this->target = $target;
//    }

}
