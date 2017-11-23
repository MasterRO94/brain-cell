<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\AddressResource;
use Brain\Cell\EntityResource\Delivery\DeliveryOptionResource;
use Brain\Cell\EntityResource\Delivery\DispatchResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

use Doctrine\Common\Collections\ArrayCollection;

class JobBatchResource extends AbstractResource
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var AddressResource
     *
     * @deprecated Will be removed very soon. Please update your code. Use the $deliveryOption
     *   in status "incomplete" or the $batchDelivery in statuses past the status "incomplete".
     */
    protected $address;

    /**
     * @var DeliveryOptionResource|null This might be null only in the "incomplete" status
     */
    protected $deliveryOption;

    /**
     * @var JobBatchBatchDeliveryResource|null This is null only in the "incomplete" status
     */
    protected $batchDelivery;

    /**
     * @var ResourceCollection|JobResource[]
     *
     * @Assert\Valid()
     * @Assert\Expression(
     *     expression="this.getJobs() && this.getJobs().count() > 0",
     *     message="There must be jobs specified for the batch"
     * )
     */
    protected $jobs;

    /**
     * @var ResourceCollection|DispatchResource[]
     *
     * @Assert\Valid()
     */
    protected $dispatches;

    public function __construct()
    {
        $this->dispatches = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            /*
             * Will be removed soon
             *
             * @deprecated
             */
            'address' => AddressResource::class,

            'deliveryOption' => DeliveryOptionResource::class,
            'batchDelivery' => JobBatchBatchDeliveryResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'jobs' => JobResource::class,
            'dispatches' => DispatchResource::class,
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
     * @deprecated
     *
     * @return AddressResource
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @deprecated
     *
     * @param AddressResource $address
     */
    public function setAddress(AddressResource $address)
    {
        $this->address = $address;
    }

    /**
     * @return DeliveryOptionResource|null
     */
    public function getDeliveryOption()
    {
        return $this->deliveryOption;
    }

    /**
     * @param DeliveryOptionResource $deliveryOption
     */
    public function setDeliveryOption(DeliveryOptionResource $deliveryOption = null)
    {
        $this->deliveryOption = $deliveryOption;
    }

    /**
     * @return JobBatchBatchDeliveryResource|null
     */
    public function getBatchDelivery()
    {
        return $this->batchDelivery;
    }

    /**
     * @param JobBatchBatchDeliveryResource $batchDelivery
     */
    public function setBatchDelivery(JobBatchBatchDeliveryResource $batchDelivery)
    {
        $this->batchDelivery = $batchDelivery;
    }

    /**
     * @return JobResource[]|ResourceCollection
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    /**
     * @param JobResource[]|ResourceCollection $jobs
     */
    public function setJobs($jobs)
    {
        $this->jobs = $jobs;
    }

    /**
     * @param DispatchResource[]|ResourceCollection $dispatches
     */
    public function setDispatches($dispatches)
    {
        $this->dispatches = $dispatches;
    }

    /**
     * @return DispatchResource[]|ResourceCollection
     */
    public function getDispatches()
    {
        return $this->dispatches;
    }

    /**
     * @param DispatchResource $dispatch
     */
    public function addDispatch($dispatch)
    {
        $this->dispatches->add($dispatch);
        $dispatch->setBatch($this);
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}
