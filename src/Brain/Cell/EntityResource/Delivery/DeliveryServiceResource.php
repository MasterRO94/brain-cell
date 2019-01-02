<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class DeliveryServiceResource extends AbstractResource
{
    use ResourcePublicIdTrait;

    /** @var DeliveryCarrierResource */
    protected $deliveryCarrier;

    /** @var string */
    protected $serviceCode;

    /** @var float */
    protected $price;

    /** @var bool */
    protected $isTracked;

    /** @var bool */
    protected $isSignedFor;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'deliveryCarrier' => DeliveryCarrierResource::class,
        ];
    }

    public function getDeliveryCarrier(): DeliveryCarrierResource
    {
        return $this->deliveryCarrier;
    }

    public function setDeliveryCarrier(DeliveryCarrierResource $deliveryCarrier): void
    {
        $this->deliveryCarrier = $deliveryCarrier;
    }

    public function getServiceCode(): string
    {
        return $this->serviceCode;
    }

    public function setServiceCode(string $serviceCode): void
    {
        $this->serviceCode = $serviceCode;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function isIsTracked(): bool
    {
        return $this->isTracked;
    }

    public function setIsTracked(bool $isTracked): void
    {
        $this->isTracked = $isTracked;
    }

    public function getIsSignedFor(): bool
    {
        return $this->isSignedFor;
    }

    public function setIsSignedFor(bool $isSignedFor): void
    {
        $this->isSignedFor = $isSignedFor;
    }
}
