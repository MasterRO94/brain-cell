<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Delivery\DeliveryResource;
use Brain\Cell\EntityResource\DimensionsResource;
use Brain\Cell\EntityResource\PriceResource;
use Brain\Cell\EntityResource\Product\ProductResource;
use Brain\Cell\EntityResource\ProductionHouseResource;
use Brain\Cell\EntityResource\ShopResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class JobResource extends AbstractResource
{
    const STATUS_INCOMPLETE = 1;
    const STATUS_READY = 200;
    const STATUS_PRODUCTION_QUEUED = 300;
    const STATUS_PRODUCTION_STARTED = 310;
    const STATUS_PRODUCTION_FINISHED = 320;
    const STATUS_PRODUCTION_DISPATCHED = 380;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var ProductionHouseResource
     */
    protected $productionHouse;

    /**
     * @var ProductResource
     */
    protected $product;

    /**
     * @var ShopResource
     */
    protected $shop;

    /**
     * @var int
     */
    protected $weight;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var \DateTime
     */
    protected $productionFinishDate;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var \DateTime
     */
    protected $updated;

    /**
     * @var ResourceCollection|JobComponentResource[]
     *
     * @Assert\Valid()
     * @Assert\Expression(
     *     expression="this.getComponents() && this.getComponents().count() > 0",
     *     message="There must be at least one component supplied"
     * )
     */
    protected $components;

    /**
     * @var JobBatchResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $batch;

    /**
     * @var DeliveryResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $delivery;

    /**
     * @var DimensionsResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $dimensions;

    /**
     * @var PriceResource
     */
    protected $price;

    /**
     * @var string
     */
    protected $reference;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'productionHouse' => ProductionHouseResource::class,
            'shop' => ShopResource::class,
            'product' => ProductResource::class,
            'delivery' => DeliveryResource::class,
            'batch' => JobBatchResource::class,
            'dimensions' => DimensionsResource::class,
            'price' => PriceResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'components' => JobComponentResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getDateTimeProperties()
    {
        return [
            'created',
            'updated',
            'productionFinishDate',
        ];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return null|ProductionHouseResource
     */
    public function getProductionHouse()
    {
        return $this->productionHouse;
    }

    /**
     * @param ProductionHouseResource $productionHouse
     *
     * @return $this
     */
    public function setProductionHouse(ProductionHouseResource $productionHouse)
    {
        $this->productionHouse = $productionHouse;
        return $this;
    }

    /**
     * @return ProductResource
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param ProductResource $product
     * @return $this
     */
    public function setProduct(ProductResource $product)
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return ShopResource
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * @param ShopResource $shop
     *
     * @return $this
     */
    public function setShop(ShopResource $shop)
    {
        $this->shop = $shop;
        return $this;
    }

    /**
     * @return JobBatchResource
     */
    public function getBatch()
    {
        return $this->batch;
    }

    /**
     * @param JobBatchResource $batch
     *
     * @return $this
     */
    public function setBatch($batch)
    {
        $this->batch = $batch;
        return $this;
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     *
     * @return JobResource
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return JobResource
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getProductionFinishDate()
    {
        return $this->productionFinishDate;
    }

    /**
     * @param \DateTime $productionFinishDate
     * @return JobResource
     */
    public function setProductionFinishDate(\DateTime $productionFinishDate)
    {
        $this->productionFinishDate = $productionFinishDate;
        return $this;
    }

    /**
     * @return ResourceCollection|JobComponentResource[]
     */
    public function getComponents()
    {
        return $this->components;
    }

    /**
     * @param ResourceCollection|JobComponentResource[] $components
     *
     * @return $this
     */
    public function setComponents(ResourceCollection $components)
    {
        $this->components = $components;
        return $this;
    }

    /**
     * @return DeliveryResource
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param DeliveryResource $delivery
     *
     * @return JobResource
     */
    public function setDelivery(DeliveryResource $delivery)
    {
        $this->delivery = $delivery;
        return $this;
    }

    /**
     * @return DimensionsResource
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * @param DimensionsResource $dimensions
     * @return JobResource
     */
    public function setDimensions($dimensions)
    {
        $this->dimensions = $dimensions;
        return $this;
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
     * @return JobResource
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     * @return JobResource
     */
    public function setUpdated(\DateTime $updated)
    {
        $this->updated = $updated;
        return $this;
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
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return int
     */
    public function getPageCount()
    {
        $pages = 0;
        foreach ($this->components as $component) {
            $pages += $component->getRangeEnd() - $component->getRangeStart();
        }
        return $pages;
    }

    /**
     * @return int
     */
    public function getSheetCount()
    {
        $sheets = 0;
        foreach ($this->components as $component) {
            $sheets += $component->getProductionSheetCount();
        }
        return $sheets;
    }

    /**
     * @return string
     */
    public function getSpecificationString()
    {
        $specificationString = '';
        foreach ($this->components as $component) {
            $specificationString .= $component->getSize()->getName(). ' ';
            $specificationString .= $component->getMaterial()->getName() . ' ';
            foreach ($component->getOptions() as $option) {
                $specificationString .= $option->getCategory()->getAlias() . '=';
                $specificationString .= $option->getItem()->getAlias() . ' ';
            }
        }
        return rtrim($specificationString);
    }

    public function hasPersonalisation()
    {
        foreach ($this->components as $component) {
            foreach ($component->getOptions() as $option) {
                if (
                    $option->getCategory()->getAlias() === 'personalisation'
                    && ! $option->getItem()->isDefault()
                ) {
                    return true;
                }
            }
        }
        return false;
    }

    public function isMultipage()
    {
        if ($this->components->count() > 1) {
            return true;
        }

        if ($this->components->count() == 1) {
            /** @var JobComponentResource $firstComponent */
            $firstComponent = $this->components->first();
            if ($firstComponent->getRangeEnd() > 1) {
                return true;
            }
        }

        return false;
    }

}
