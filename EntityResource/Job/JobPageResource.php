<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

/**
 * {@inheritdoc}
 */
class JobPageResource extends AbstractResource
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $status;

    /**
     * @var ResourceCollection|JobPageOptionResource[]
     */
    protected $options;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'options' => JobPageOptionResource::class
        ];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return ResourceCollection|JobPageOptionResource[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param ResourceCollection|JobPageOptionResource[] $options
     *
     * @return JobPageResource
     */
    public function setOptions(ResourceCollection $options)
    {
        $this->options = $options;
        return $this;
    }

}
