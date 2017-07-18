<?php

/**
 * Created by PhpStorm.
 * User: liam.miller
 * Date: 17/07/2017
 * Time: 11:58
 */

namespace Brain\Cell\EntityResource\Dispatch;

use Brain\Cell\EntityResource\Job\JobBatchResource;
use Brain\Cell\Transfer\AbstractResource;

class DispatchResource extends AbstractResource
{

    /**
     * @var string
     */
    protected $id;

    /**
     * @var JobBatchResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $jobBatch;

    /**
     * @var string
     */
    protected $trackingCode;

    /**
     * @var string
     */
    protected $label;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'jobBatch' => JobBatchResource::class,
        ];
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return JobBatchResource|null
     */
    public function getJobBatch()
    {
        return $this->jobBatch;
    }

    /**
     * @param JobBatchResource|null $jobBatch
     */
    public function setJobBatch(JobBatchResource $jobBatch = null)
    {
        $this->jobBatch = $jobBatch;
    }

    public function clearJobBatch()
    {
        $this->jobBatch = null;
    }

    /**
     * @return string|null
     */
    public function getTrackingCode()
    {
        return $this->trackingCode;
    }

    /**
     * @param string $trackingCode
     */
    public function setTrackingCode($trackingCode)
    {
        $this->trackingCode = $trackingCode;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }
}
