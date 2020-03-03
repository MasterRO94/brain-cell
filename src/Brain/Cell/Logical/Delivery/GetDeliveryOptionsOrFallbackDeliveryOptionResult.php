<?php

declare(strict_types=1);

namespace Brain\Cell\Logical\Delivery;

use Brain\Cell\EntityResource\Delivery\DeliveryOptionResource;
use Brain\Cell\Transfer\ResourceCollection;

use Throwable;

class GetDeliveryOptionsOrFallbackDeliveryOptionResult
{
    /** @var DeliveryOptionResource[]|ResourceCollection */
    private $deliveryOptionsCollection;

    /** @var Throwable|null */
    private $normalDeliveryOptionsCreationException;

    public function __construct(
        ResourceCollection $deliveryOptionsCollection,
        ?Throwable $normalDeliveryOptionsCreationException
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
     */
    public function getNormalDeliveryOptionsCreationException(): ?Throwable
    {
        return $this->normalDeliveryOptionsCreationException;
    }
}
