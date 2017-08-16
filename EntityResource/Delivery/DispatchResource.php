<?php

/**
 * Created by PhpStorm.
 * User: liam.miller
 * Date: 17/07/2017
 * Time: 11:58
 */

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\EntityResource\Job\JobBatchResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

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
    protected $labelUrl;

    /**
     * @var DispatchParcelResource[] $parcels
     */
    protected $parcels;

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
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'parcels' => DispatchParcelResource::class,
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
     * @return DispatchParcelResource[]|ResourceCollection
     */
    public function getParcels()
    {
        return $this->parcels;
    }

    /**
     * @param DispatchParcelResource[] $parcels
     */
    public function setParcels($parcels)
    {
        $this->parcels = $parcels;
    }

    /**
     * @return string
     */
    public function getLabelUrl()
    {
        return $this->labelUrl;
    }

    /**
     * @param string $labelUrl
     */
    public function setLabelUrl($labelUrl)
    {
        $this->labelUrl = $labelUrl;
    }
}
