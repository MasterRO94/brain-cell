<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Delivery\DeliveryResource;
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
     * @var ShopResource
     */
    protected $shop;

    /**
     * @var int
     */
    protected $weight;

    /**
     * @var ResourceCollection|JobPageResource[]
     *
     * @Assert\Valid()
     * @Assert\Expression(
     *     expression="this.getPages() && this.getPages().count() > 0",
     *     message="There must be at least one page supplied"
     * )
     */
    protected $pages;

    /**
     * @var DeliveryResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $delivery;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'productionHouse' => ProductionHouseResource::class,
            'shop' => ShopResource::class,
            'delivery' => DeliveryResource::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'pages' => JobPageResource::class
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
     * @return ResourceCollection|JobPageResource[]
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param ResourceCollection|JobPageResource[] $pages
     *
     * @return $this
     */
    public function setPages(ResourceCollection $pages)
    {
        $this->pages = $pages;
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

}
