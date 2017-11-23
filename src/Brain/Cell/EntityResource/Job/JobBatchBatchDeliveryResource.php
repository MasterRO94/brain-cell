<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\AddressResource;
use Brain\Cell\EntityResource\Delivery\DeliveryServiceResource;
use Brain\Cell\EntityResource\Delivery\ProductionStrategyResource;
use Brain\Cell\Transfer\AbstractResource;

/**
 * Class JobBatchBatchDeliveryResource
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

    /** @var \DateTime|null */
    protected $assumedStartOfProductionDate;

    /** @var \DateTime|null */
    protected $endOfProductionDate;

    /** @var \DateTime|null */
    protected $deliveryCollectionDate;

    /** @var \DateTime|null */
    protected $deliveryDateEarliest;

    /** @var \DateTime|null */
    protected $deliveryDateLatest;

    /** @var string|null E.g. "08:30" */
    protected $deliveryTimeFrameEarliest;

    /** @var string|null E.g. "21:44" */
    protected $deliveryTimeFrameLatest;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'deliveryAddress' => AddressResource::class,
            'productionStrategy' => ProductionStrategyResource::class,
            'deliveryService' => DeliveryServiceResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getDateTimeProperties()
    {
        return [
            'assumedStartOfProductionDate',
            'endOfProductionDate',
            'deliveryCollectionDate',
            'deliveryDateLatest',
            'deliveryDateEarliest',
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
     * @return \DateTime|null
     */
    public function getAssumedStartOfProductionDate()
    {
        return $this->assumedStartOfProductionDate;
    }

    /**
     * @param \DateTime $assumedStartOfProductionDate
     */
    public function setAssumedStartOfProductionDate(\DateTime $assumedStartOfProductionDate)
    {
        $this->assumedStartOfProductionDate = $assumedStartOfProductionDate;
    }

    /**
     * @return \DateTime|null
     */
    public function getEndOfProductionDate()
    {
        return $this->endOfProductionDate;
    }

    /**
     * @param \DateTime $endOfProductionDate
     */
    public function setEndOfProductionDate(\DateTime $endOfProductionDate)
    {
        $this->endOfProductionDate = $endOfProductionDate;
    }

    /**
     * @return \DateTime|null
     */
    public function getDeliveryCollectionDate()
    {
        return $this->deliveryCollectionDate;
    }

    /**
     * @param \DateTime $deliveryCollectionDate
     */
    public function setDeliveryCollectionDate(\DateTime $deliveryCollectionDate)
    {
        $this->deliveryCollectionDate = $deliveryCollectionDate;
    }

    /**
     * @return \DateTime|null
     */
    public function getDeliveryDateEarliest()
    {
        return $this->deliveryDateEarliest;
    }

    /**
     * @param \DateTime $deliveryDateEarliest
     */
    public function setDeliveryDateEarliest(\DateTime $deliveryDateEarliest)
    {
        $this->deliveryDateEarliest = $deliveryDateEarliest;
    }

    /**
     * @return \DateTime|null
     */
    public function getDeliveryDateLatest()
    {
        return $this->deliveryDateLatest;
    }

    /**
     * @param \DateTime $deliveryDateLatest
     */
    public function setDeliveryDateLatest(\DateTime $deliveryDateLatest)
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
