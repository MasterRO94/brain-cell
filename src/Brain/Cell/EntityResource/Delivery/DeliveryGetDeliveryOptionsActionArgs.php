<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\EntityResource\Country\AddressResource;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\Transformer\ArrayEncoder;

/**
 * {@inheritdoc}
 */
class DeliveryGetDeliveryOptionsActionArgs extends AbstractResource
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
     * @var array See setters.
     */
    protected $options = [];

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

    /**
     * {@inheritdoc}
     */
    public function getFieldsCustomSerialisationFunctions(): array
    {
        return [
            'options' => function (ArrayEncoder $arrayEncoder) {
                $actionArgsOptions = $this->options;

                /*
                 * Serialise the lifetime field
                 */
                if (
                    array_key_exists('minimal_delivery_options_lifetime', $actionArgsOptions)
                    && $actionArgsOptions['minimal_delivery_options_lifetime']
                ) {
                    $actionArgsOptions['minimal_delivery_options_lifetime']
                        = $arrayEncoder->encodeDateTimeValue($actionArgsOptions['minimal_delivery_options_lifetime']);
                }

                return $actionArgsOptions;
            },
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

    public function setOptionMinimalDeliveryOptionsLifetime(?\DateTime $minimalLifetime): void
    {
        $this->options['minimal_delivery_options_lifetime'] = $minimalLifetime;
    }

    public function setOptionFastGenerationRoutine(bool $isEnabled): void
    {
        $this->options['fast_generation_routine'] = $isEnabled;
    }

    public function setOptionFallbackDeliveryOptionOnly(bool $isEnabled): void
    {
        $this->options['fallback_delivery_option_only'] = $isEnabled;
    }
}
