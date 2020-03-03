<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\EntityResource\Country\AddressResource;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\Transformer\ArrayEncoder;

use DateTime;

/**
 * {@inheritdoc}
 */
class GetDeliveryOptionsArgs extends AbstractResource
{
    /**
     * @Assert\Valid()
     * @Assert\NotBlank()
     *
     * @var AddressResource
     */
    protected $deliveryAddress;

    /**
     * @Assert\Valid()
     * @Assert\Expression(
     *     expression="this.getJobs() && this.getJobs().count() > 0",
     *     message="There must be jobs specified for the batch"
     * )
     *
     * @var JobResource[]|ResourceCollection
     */
    protected $jobs;

    /**
     * @Assert\Valid()
     *
     * @var GetDeliveryOptionsOptionsResource|null
     */
    protected $options;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'deliveryAddress' => AddressResource::class,
            'options' => GetDeliveryOptionsOptionsResource::class,
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
    public function setJobs(ResourceCollection $jobs): void
    {
        $this->jobs = $jobs;
    }

    /**
     * @return GetDeliveryOptionsOptionsResource|null
     */
    public function getOptions(): ?GetDeliveryOptionsOptionsResource
    {
        return $this->options;
    }

    /**
     * @param GetDeliveryOptionsOptionsResource|null $options
     */
    public function setOptions(?GetDeliveryOptionsOptionsResource $options): void
    {
        $this->options = $options;
    }
}
