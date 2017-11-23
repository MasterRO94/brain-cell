<?php

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\EntityResource\AddressResource;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

/**
 * {@inheritdoc}
 *
 * This is only temporary as we have an inconsistency with payloads.
 * Will be fixed soon.
 */
class DeliveryJobBatchResource extends AbstractResource
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var AddressResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $deliveryAddress;

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
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'deliveryAddress' => AddressResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'jobs' => JobResource::class,
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
     * @return AddressResource
     */
    public function getDeliveryAddress(): AddressResource
    {
        return $this->deliveryAddress;
    }

    /**
     * @param AddressResource $deliveryAddress
     */
    public function setDeliveryAddress(AddressResource $deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * @deprecated Left for BC
     *
     * @return AddressResource
     */
    public function getAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * @deprecated Left for BC
     *
     * @param AddressResource $address
     */
    public function setAddress(AddressResource $address)
    {
        $this->deliveryAddress = $address;
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
}
