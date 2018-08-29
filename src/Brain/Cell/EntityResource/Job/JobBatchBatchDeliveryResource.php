<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\AddressResource;
use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Delivery\DeliveryServiceResource;
use Brain\Cell\EntityResource\Delivery\ProductionStrategyResource;
use Brain\Cell\Transfer\AbstractResource;

/**
 * Class JobBatchBatchDeliveryResource.
 *
 * All fields in this resource are nullable, but you are guaranteed, that the api will never
 * return nulls for any of these fields.
 *
 * These fields are nullable, because you can send this object "partially" to the api.
 */
class JobBatchBatchDeliveryResource extends AbstractResource
{
    /** @var AddressResource|null */
    protected $deliveryAddress;

    /** @var ProductionStrategyResource|null */
    protected $productionStrategy;

    /** @var DeliveryServiceResource|null */
    protected $deliveryService;

    /** @var DateResource|null */
    protected $assumedStartOfProductionDate;

    /** @var DateResource|null */
    protected $endOfProductionDate;

    /** @var DateResource|null */
    protected $deliveryCollectionDate;

    /** @var DateResource|null */
    protected $deliveryDateEarliest;

    /** @var DateResource|null */
    protected $deliveryDateLatest;

    /** @var string|null E.g. "08:30" */
    protected $deliveryTimeFrameEarliest;

    /** @var string|null E.g. "21:44" */
    protected $deliveryTimeFrameLatest;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'deliveryAddress' => AddressResource::class,
            'productionStrategy' => ProductionStrategyResource::class,
            'deliveryService' => DeliveryServiceResource::class,
            'assumedStartOfProductionDate' => DateResource::class,
            'endOfProductionDate' => DateResource::class,
            'deliveryCollectionDate' => DateResource::class,
            'deliveryDateEarliest' => DateResource::class,
            'deliveryDateLatest' => DateResource::class,
        ];
    }

    /**
     * @return AddressResource|null
     */
    public function getDeliveryAddress()
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
     * @return ProductionStrategyResource|null
     */
    public function getProductionStrategy()
    {
        return $this->productionStrategy;
    }

    /**
     * @param ProductionStrategyResource $productionStrategy
     */
    public function setProductionStrategy(ProductionStrategyResource $productionStrategy)
    {
        $this->productionStrategy = $productionStrategy;
    }

    /**
     * @return DeliveryServiceResource|null
     */
    public function getDeliveryService()
    {
        return $this->deliveryService;
    }

    /**
     * @param DeliveryServiceResource $deliveryService
     */
    public function setDeliveryService(DeliveryServiceResource $deliveryService)
    {
        $this->deliveryService = $deliveryService;
    }

    /**
     * @return DateResource|null
     */
    public function getAssumedStartOfProductionDate()
    {
        return $this->assumedStartOfProductionDate;
    }

    /**
     * @param DateResource $assumedStartOfProductionDate
     */
    public function setAssumedStartOfProductionDate(DateResource $assumedStartOfProductionDate)
    {
        $this->assumedStartOfProductionDate = $assumedStartOfProductionDate;
    }

    /**
     * @return DateResource|null
     */
    public function getEndOfProductionDate()
    {
        return $this->endOfProductionDate;
    }

    /**
     * @param DateResource $endOfProductionDate
     */
    public function setEndOfProductionDate(DateResource $endOfProductionDate)
    {
        $this->endOfProductionDate = $endOfProductionDate;
    }

    /**
     * @return DateResource|null
     */
    public function getDeliveryCollectionDate()
    {
        return $this->deliveryCollectionDate;
    }

    /**
     * @param DateResource $deliveryCollectionDate
     */
    public function setDeliveryCollectionDate(DateResource $deliveryCollectionDate)
    {
        $this->deliveryCollectionDate = $deliveryCollectionDate;
    }

    /**
     * @return DateResource|null
     */
    public function getDeliveryDateEarliest()
    {
        return $this->deliveryDateEarliest;
    }

    /**
     * @param DateResource $deliveryDateEarliest
     */
    public function setDeliveryDateEarliest(DateResource $deliveryDateEarliest)
    {
        $this->deliveryDateEarliest = $deliveryDateEarliest;
    }

    /**
     * @return DateResource|null
     */
    public function getDeliveryDateLatest()
    {
        return $this->deliveryDateLatest;
    }

    /**
     * @param DateResource $deliveryDateLatest
     */
    public function setDeliveryDateLatest(DateResource $deliveryDateLatest)
    {
        $this->deliveryDateLatest = $deliveryDateLatest;
    }

    /**
     * @return string|null
     */
    public function getDeliveryTimeFrameEarliest()
    {
        return $this->deliveryTimeFrameEarliest;
    }

    /**
     * @param string $deliveryTimeFrameEarliest
     */
    public function setDeliveryTimeFrameEarliest($deliveryTimeFrameEarliest)
    {
        $this->deliveryTimeFrameEarliest = $deliveryTimeFrameEarliest;
    }

    /**
     * @return string|null
     */
    public function getDeliveryTimeFrameLatest()
    {
        return $this->deliveryTimeFrameLatest;
    }

    /**
     * @param string $deliveryTimeFrameLatest
     */
    public function setDeliveryTimeFrameLatest($deliveryTimeFrameLatest)
    {
        $this->deliveryTimeFrameLatest = $deliveryTimeFrameLatest;
    }
}
