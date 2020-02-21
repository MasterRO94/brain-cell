<?php

namespace Brain\Cell\Logical\Delivery;

use Brain\Cell\EntityResource\Delivery\DeliveryOptionResource;
use Brain\Cell\Transfer\ResourceCollection;
use Exception;

class GetDeliveryOptionsOrFallbackDeliveryOptionResult
{
    /** * @var DeliveryOptionResource[]|ResourceCollection */
    private $deliveryOptionsCollection;

    /** * @var Exception|null */
    private $normalDeliveryOptionsCreationException;

    public function __construct(
        ResourceCollection $deliveryOptionsCollection,
        ?Exception $normalDeliveryOptionsCreationException
    ) {
        $this->deliveryOptionsCollection = $deliveryOptionsCollection;
        $this->normalDeliveryOptionsCreationException = $normalDeliveryOptionsCreationException;
    }

    /**
     * @return DeliveryOptionResource[]|ResourceCollection
     */
    public function getDeliveryOptionsCollection()
    {
        return $this->deliveryOptionsCollection;
    }

    /**
     * If set, it means that creating normal delivery options failed with the exception provided.
     *
     * @return Exception|null
     */
    public function getNormalDeliveryOptionsCreationException(): ?Exception
    {
        return $this->normalDeliveryOptionsCreationException;
    }
}