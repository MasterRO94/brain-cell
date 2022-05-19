<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\EntityResource\ClientResource;
use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Country\AddressResource;
use Brain\Cell\EntityResource\Country\AddressResourceInterface;
use Brain\Cell\EntityResource\Pricing\PriceResource;
use Brain\Cell\EntityResource\Pricing\PriceResourceInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;

use DateTime;

/**
 * {@inheritdoc}
 */
class DeliveryOptionResource extends AbstractResource implements
    DeliveryOptionResourceInterface
{
    use ResourceIdentityTrait;
    use CreatedAtTrait;

    /** @var AddressResourceInterface */
    protected $deliveryAddress;

    /**
     * @deprecated Use ::turnaround instead.
     *
     * @var ProductionStrategyResource
     */
    protected $productionStrategy;

    /** @var TurnaroundResource */
    protected $turnaround;

    /**
     * Turnaround parameters are different per different Turnaround instance. Example: some turnarounds
     * mention whether the time estimations were evaluated against "standard" or "premium" production cut-off times.
     *
     * @var mixed[]
     */
    protected $turnaroundParameters;

    /** @var DeliveryServiceResource */
    protected $deliveryService;

    /** @var DateResource */
    protected $evaluationDate;

    /** @var DateResource */
    protected $assumedStartOfProductionDate;

    /** @var DateResource */
    protected $endOfProductionDate;

    /** @var DateResource */
    protected $deliveryDateEarliest;

    /** @var DateResource */
    protected $deliveryCollectionDate;

    /** @var DateResource */
    protected $deliveryDateLatest;

    /** @var string */
    protected $deliveryTimeFrameEarliest;

    /** @var string */
    protected $deliveryTimeFrameLatest;

    /** @var PriceResourceInterface */
    protected $productionStrategyPrice;

    /** @var PriceResourceInterface */
    protected $deliveryServicePrice;

    /** @var PriceResourceInterface */
    protected $price;

    /** @var DateResource|null Null indicates that the delivery option is valid infinitely. This has a very limited use case. */
    protected $lifetimeFinishDate;

    /** @var ClientResource */
    protected $productionHouse;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'deliveryAddress' => AddressResource::class,
            /** @deprecated Use ::turnaround instead */
            'productionStrategy' => ProductionStrategyResource::class,
            'turnaround' => TurnaroundResource::class,
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
            'productionHouse' => ClientResource::class,
        ];
    }

    public function getDeliveryAddress(): AddressResourceInterface
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(AddressResourceInterface $deliveryAddress): void
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * @deprecated Use ::getTurnaround() instead.
     */
    public function getProductionStrategy(): ProductionStrategyResource
    {
        return $this->productionStrategy;
    }

    public function setProductionStrategy(ProductionStrategyResource $productionStrategy): void
    {
        $this->productionStrategy = $productionStrategy;
    }

    public function getTurnaround(): TurnaroundResource
    {
        return $this->turnaround;
    }

    public function setTurnaround(TurnaroundResource $turnaround): void
    {
        $this->turnaround = $turnaround;
    }

    /**
     * @return mixed[]
     */
    public function getTurnaroundParameters(): array
    {
        return $this->turnaroundParameters;
    }

    /**
     * @param mixed[] $turnaroundParameters
     */
    public function setTurnaroundParameters(array $turnaroundParameters): void
    {
        $this->turnaroundParameters = $turnaroundParameters;
    }

    public function getDeliveryService(): DeliveryServiceResource
    {
        return $this->deliveryService;
    }

    public function setDeliveryService(DeliveryServiceResource $deliveryService): void
    {
        $this->deliveryService = $deliveryService;
    }

    public function getEvaluationDate(): DateResource
    {
        return $this->evaluationDate;
    }

    public function setEvaluationDate(DateResource $evaluationDate): void
    {
        $this->evaluationDate = $evaluationDate;
    }

    public function getAssumedStartOfProductionDate(): DateResource
    {
        return $this->assumedStartOfProductionDate;
    }

    public function setAssumedStartOfProductionDate(DateResource $assumedStartOfProductionDate): void
    {
        $this->assumedStartOfProductionDate = $assumedStartOfProductionDate;
    }

    public function getEndOfProductionDate(): DateResource
    {
        return $this->endOfProductionDate;
    }

    public function setEndOfProductionDate(DateResource $endOfProductionDate): void
    {
        $this->endOfProductionDate = $endOfProductionDate;
    }

    public function getDeliveryCollectionDate(): DateResource
    {
        return $this->deliveryCollectionDate;
    }

    public function setDeliveryCollectionDate(DateResource $deliveryCollectionDate): void
    {
        $this->deliveryCollectionDate = $deliveryCollectionDate;
    }

    public function getDeliveryDateEarliest(): DateResource
    {
        return $this->deliveryDateEarliest;
    }

    public function setDeliveryDateEarliest(DateResource $deliveryDateEarliest): void
    {
        $this->deliveryDateEarliest = $deliveryDateEarliest;
    }

    public function getDeliveryDateLatest(): DateResource
    {
        return $this->deliveryDateLatest;
    }

    public function setDeliveryDateLatest(DateResource $deliveryDateLatest): void
    {
        $this->deliveryDateLatest = $deliveryDateLatest;
    }

    public function getDeliveryTimeFrameEarliest(): string
    {
        return $this->deliveryTimeFrameEarliest;
    }

    public function setDeliveryTimeFrameEarliest(string $deliveryTimeFrameEarliest): void
    {
        $this->deliveryTimeFrameEarliest = $deliveryTimeFrameEarliest;
    }

    public function getDeliveryTimeFrameLatest(): string
    {
        return $this->deliveryTimeFrameLatest;
    }

    public function setDeliveryTimeFrameLatest(string $deliveryTimeFrameLatest): void
    {
        $this->deliveryTimeFrameLatest = $deliveryTimeFrameLatest;
    }

    public function getProductionStrategyPrice(): PriceResourceInterface
    {
        return $this->productionStrategyPrice;
    }

    public function setProductionStrategyPrice(PriceResourceInterface $productionStrategyPrice): void
    {
        $this->productionStrategyPrice = $productionStrategyPrice;
    }

    public function getDeliveryServicePrice(): PriceResourceInterface
    {
        return $this->deliveryServicePrice;
    }

    public function setDeliveryServicePrice(PriceResourceInterface $deliveryServicePrice): void
    {
        $this->deliveryServicePrice = $deliveryServicePrice;
    }

    public function getPrice(): PriceResourceInterface
    {
        return $this->price;
    }

    public function setPrice(PriceResourceInterface $price): void
    {
        $this->price = $price;
    }

    public function getLifetimeFinishDate(): DateResource
    {
        if ($this->lifetimeFinishDate instanceof DateResource) {
            return $this->lifetimeFinishDate;
        }

        /*
         * Ideally, this function would return null, but at the time of writing this, there were projects that were
         * not handling the null case (which was added later). @todo Make the projects in question handle nulls and
         * rewrite the following.
         *
         * In case of null, return the evaluation date + a sensible amount of time that in principle indicates "forever".
         */

        $lifetimeDateAsForever = (new DateTime($this->evaluationDate->asDateTime()->format('c')))
            ->modify('+3 months');

        $lifetimeDateResource = new DateResource();
        $lifetimeDateResource->setIso($lifetimeDateAsForever->format('c'));
        $lifetimeDateResource->setTimezone($this->evaluationDate->getTimezone());

        return $lifetimeDateResource;
    }

    public function setLifetimeFinishDate(?DateResource $lifetimeFinishDate): void
    {
        $this->lifetimeFinishDate = $lifetimeFinishDate;
    }

    public function getProductionHouse(): ClientResource
    {
        return $this->productionHouse;
    }

    public function setProductionHouse(ClientResource $productionHouse): void
    {
        $this->productionHouse = $productionHouse;
    }
}
