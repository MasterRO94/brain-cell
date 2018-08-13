<?php

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class DeliveryServiceResource extends AbstractResource
{
    use ResourcePublicIdTrait;

    /**
     * @var DeliveryCarrierResource
     */
    protected $deliveryCarrier;

    /**
     * @var string
     */
    protected $serviceCode;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var bool
     */
    protected $isTracked;

    /**
     * @var bool
     */
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

    /**
     * @return string
     */
    public function getDeliveryCarrier()
    {
        return $this->deliveryCarrier;
    }

    /**
     * @param $deliveryCarrier
     */
    public function setDeliveryCarrier($deliveryCarrier)
    {
        $this->deliveryCarrier = $deliveryCarrier;
    }

    /**
     * @return string
     */
    public function getServiceCode()
    {
        return $this->serviceCode;
    }

    /**
     * @param string $serviceCode
     */
    public function setServiceCode(string $serviceCode)
    {
        $this->serviceCode = $serviceCode;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return bool
     */
    public function isIsTracked()
    {
        return $this->isTracked;
    }

    /**
     * @param bool $isTracked
     */
    public function setIsTracked(bool $isTracked)
    {
        $this->isTracked = $isTracked;
    }

    /**
     * @return bool
     */
    public function getIsSignedFor()
    {
        return $this->isSignedFor;
    }

    /**
     * @param bool $isSignedFor
     */
    public function setIsSignedFor(bool $isSignedFor)
    {
        $this->isSignedFor = $isSignedFor;
    }
}
