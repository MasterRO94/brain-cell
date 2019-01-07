<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Country\AddressResource;
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

    public function getDeliveryAddress(): ?AddressResource
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(AddressResource $deliveryAddress): void
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    public function getProductionStrategy(): ?ProductionStrategyResource
    {
        return $this->productionStrategy;
    }

    public function setProductionStrategy(ProductionStrategyResource $productionStrategy): void
    {
        $this->productionStrategy = $productionStrategy;
    }

    public function getDeliveryService(): ?DeliveryServiceResource
    {
        return $this->deliveryService;
    }

    public function setDeliveryService(DeliveryServiceResource $deliveryService): void
    {
        $this->deliveryService = $deliveryService;
    }

    public function getAssumedStartOfProductionDate(): ?DateResource
    {
        return $this->assumedStartOfProductionDate;
    }

    public function setAssumedStartOfProductionDate(DateResource $assumedStartOfProductionDate): void
    {
        $this->assumedStartOfProductionDate = $assumedStartOfProductionDate;
    }

    public function getEndOfProductionDate(): ?DateResource
    {
        return $this->endOfProductionDate;
    }

    public function setEndOfProductionDate(DateResource $endOfProductionDate): void
    {
        $this->endOfProductionDate = $endOfProductionDate;
    }

    public function getDeliveryCollectionDate(): ?DateResource
    {
        return $this->deliveryCollectionDate;
    }

    public function setDeliveryCollectionDate(DateResource $deliveryCollectionDate): void
    {
        $this->deliveryCollectionDate = $deliveryCollectionDate;
    }

    public function getDeliveryDateEarliest(): ?DateResource
    {
        return $this->deliveryDateEarliest;
    }

    public function setDeliveryDateEarliest(DateResource $deliveryDateEarliest): void
    {
        $this->deliveryDateEarliest = $deliveryDateEarliest;
    }

    public function getDeliveryDateLatest(): ?DateResource
    {
        return $this->deliveryDateLatest;
    }

    public function setDeliveryDateLatest(DateResource $deliveryDateLatest): void
    {
        $this->deliveryDateLatest = $deliveryDateLatest;
    }

    public function getDeliveryTimeFrameEarliest(): ?string
    {
        return $this->deliveryTimeFrameEarliest;
    }

    public function setDeliveryTimeFrameEarliest(string $deliveryTimeFrameEarliest): void
    {
        $this->deliveryTimeFrameEarliest = $deliveryTimeFrameEarliest;
    }

    public function getDeliveryTimeFrameLatest(): ?string
    {
        return $this->deliveryTimeFrameLatest;
    }

    public function setDeliveryTimeFrameLatest(string $deliveryTimeFrameLatest): void
    {
        $this->deliveryTimeFrameLatest = $deliveryTimeFrameLatest;
    }
}
