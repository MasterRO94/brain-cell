<?php

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
    protected $batch;

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
            'batch' => JobBatchResource::class,
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
    public function getBatch()
    {
        return $this->batch;
    }

    /**
     * @param JobBatchResource|null $batch
     */
    public function setBatch(JobBatchResource $batch = null)
    {
        $this->batch = $batch;
    }

    public function clearBatch()
    {
        $this->batch = null;
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
     * @param DispatchParcelResource[]|ResourceCollection $parcels
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
