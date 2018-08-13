<?php

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\EntityResource\AddressResource;
use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\PriceResource;
use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class DeliveryOptionResource extends AbstractResource
{
    use ResourcePublicIdTrait;
    use CreatedAtTrait;

    /**
     * @var AddressResource
     */
    protected $deliveryAddress;

    /**
     * @var ProductionStrategyResource
     */
    protected $productionStrategy;

    /**
     * @var DeliveryServiceResource
     */
    protected $deliveryService;

    /**
     * @var DateResource
     */
    protected $evaluationDate;

    /**
     * @var DateResource
     */
    protected $assumedStartOfProductionDate;

    /**
     * @var DateResource
     */
    protected $endOfProductionDate;

    /**
     * @var DateResource
     */
    protected $deliveryDateEarliest;

    /**
     * @var DateResource
     */
    protected $deliveryCollectionDate;

    /**
     * @var DateResource
     */
    protected $deliveryDateLatest;

    /**
     * @var string
     */
    protected $deliveryTimeFrameEarliest;

    /**
     * @var string
     */
    protected $deliveryTimeFrameLatest;

    /**
     * @var PriceResource
     */
    protected $productionStrategyPrice;

    /**
     * @var PriceResource
     */
    protected $deliveryServicePrice;

    /**
     * @var PriceResource
     */
    protected $price;

    /**
     * @var DateResource
     */
    protected $lifetimeFinishDate;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'deliveryAddress' => AddressResource::class,
            'productionStrategy' => ProductionStrategyResource::class,
            'deliveryService' => DeliveryServiceResource::class,
            'productionStrategyPrice' => PriceResource::class,
            'deliveryServicePrice' => PriceResource::class,
            'price' => PriceResource::class,
            'evaluationDate' => DateResource::class,
            'assumedStartOfProductionDate' => DateResource::class,
            'endOfProductionDate' => DateResource::class,
            'deliveryCollectionDate' => DateResource::class,
            'lifetimeFinishDate' => DateResource::class,
            'deliveryDateLatest' => DateResource::class,
            'deliveryDateEarliest' => DateResource::class,
            'createdAt' => DateResource::class,
        ];
    }

    /**
     * @return AddressResource
     */
    public function getDeliveryAddress(): AddressResource
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
     * @return ProductionStrategyResource
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
     * @return DeliveryServiceResource
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
     * @return DateResource
     */
    public function getEvaluationDate()
    {
        return $this->evaluationDate;
    }

    /**
     * @param DateResource $evaluationDate
     */
    public function setEvaluationDate(DateResource $evaluationDate)
    {
        $this->evaluationDate = $evaluationDate;
    }

    /**
     * @return DateResource
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
     * @return DateResource
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
     * @return DateResource
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
     * @return DateResource
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
     * @return DateResource
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
     * @return string
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
     * @return string
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

    /**
     * @return PriceResource
     */
    public function getProductionStrategyPrice()
    {
        return $this->productionStrategyPrice;
    }

    /**
     * @param PriceResource $productionStrategyPrice
     */
    public function setProductionStrategyPrice($productionStrategyPrice)
    {
        $this->productionStrategyPrice = $productionStrategyPrice;
    }

    /**
     * @return PriceResource
     */
    public function getDeliveryServicePrice()
    {
        return $this->deliveryServicePrice;
    }

    /**
     * @param PriceResource $deliveryServicePrice
     */
    public function setDeliveryServicePrice($deliveryServicePrice)
    {
        $this->deliveryServicePrice = $deliveryServicePrice;
    }

    /**
     * @return PriceResource
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param PriceResource $price
     */
    public function setPrice(PriceResource $price)
    {
        $this->price = $price;
    }

    /**
     * @return DateResource
     */
    public function getLifetimeFinishDate()
    {
        return $this->lifetimeFinishDate;
    }

    /**
     * @param DateResource $lifetimeFinishDate
     */
    public function setLifetimeFinishDate(DateResource $lifetimeFinishDate)
    {
        $this->lifetimeFinishDate = $lifetimeFinishDate;
    }
}
