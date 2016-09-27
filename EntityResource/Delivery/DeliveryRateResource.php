<?php

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\Transfer\AbstractResource;

class DeliveryRateResource extends AbstractResource
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $carrier;

    /**
     * @var string
     */
    protected $service;

    /**
     * @var float
     */
    protected $price;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return DeliveryRateResource
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param string $carrier
     *
     * @return DeliveryRateResource
     */
    public function setCarrier($carrier)
    {
        $this->carrier = $carrier;
        return $this;
    }

    /**
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param string $service
     *
     * @return DeliveryRateResource
     */
    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     *
     * @return DeliveryRateResource
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

}
