<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\Transfer\AbstractResource;

class JobNoteResource extends AbstractResource
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $summary;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var \DateTime
     */
    protected $updated;

    //todo this would be helpful
//    /**
//     * @var string
//     */
//    protected $target;

    public function getId()
    {
        return $this->id;
    }

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
     * @return string
     */
    public function getDescription()
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

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
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
