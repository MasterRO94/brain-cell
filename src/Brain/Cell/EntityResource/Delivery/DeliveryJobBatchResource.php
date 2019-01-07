<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\EntityResource\Country\AddressResource;
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
    /** @var string */
    protected $id;

    /**
     * @var AddressResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $deliveryAddress;

    /**
     * @var JobResource[]|ResourceCollection
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
    public function getAssociatedResources(): array
    {
        return [
            'deliveryAddress' => AddressResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections(): array
    {
        return [
            'jobs' => JobResource::class,
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDeliveryAddress(): AddressResource
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(AddressResource $deliveryAddress): void
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * @deprecated Left for BC
     */
    public function getAddress(): AddressResource
    {
        return $this->deliveryAddress;
    }

    /**
     * @deprecated Left for BC
     */
    public function setAddress(AddressResource $address): void
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
    public function setJobs($jobs): void
    {
        $this->jobs = $jobs;
    }
}
