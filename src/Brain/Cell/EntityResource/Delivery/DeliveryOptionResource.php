<?php

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\EntityResource\AddressResource;
use Brain\Cell\EntityResource\PriceResource;
use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class DeliveryOptionResource extends AbstractResource
{
    use ResourcePublicIdTrait;

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
     * @var \DateTime
     */
    protected $evaluationDate;

    /**
     * @var \DateTime
     */
    protected $assumedStartOfProductionDate;

    /**
     * @var \DateTime
     */
    protected $endOfProductionDate;

    /**
     * @var \DateTime
     */
    protected $deliveryDateEarliest;

    /**
     * @var \DateTime
     */
    protected $deliveryCollectionDate;

    /**
     * @var \DateTime
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
     * @var \DateTime
     */
    protected $lifetimeFinishDate;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'deliveryAddress' => AddressResource::class,
            'productionStrategy' => ProductionStrategyResource::class,
            'deliveryService' => DeliveryServiceResource::class,
            'productionStrategyPrice' => PriceResource::class,
            'deliveryServicePrice' => PriceResource::class,
            'price' => PriceResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getDateTimeProperties()
    {
        return [
            'created',
            'evaluationDate',
            'assumedStartOfProductionDate',
            'endOfProductionDate',
            'deliveryCollectionDate',
            'lifetimeFinishDate',
            'deliveryDateLatest',
            'deliveryDateEarliest',
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
     * @return \DateTime
     */
    public function getEvaluationDate()
    {
        return $this->evaluationDate;
    }

    /**
     * @param \DateTime $evaluationDate
     */
    public function setEvaluationDate(\DateTime $evaluationDate)
    {
        $this->evaluationDate = $evaluationDate;
    }

    /**
     * @return \DateTime
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
     * @return \DateTime
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
     * @return \DateTime
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
     * @return \DateTime
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
     * @return \DateTime
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
     * @return \DateTime
     */
    public function getLifetimeFinishDate()
    {
        return $this->lifetimeFinishDate;
    }

    /**
     * @param \DateTime $lifetimeFinishDate
     */
    public function setLifetimeFinishDate(\DateTime $lifetimeFinishDate)
    {
        $this->lifetimeFinishDate = $lifetimeFinishDate;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
    }
}
