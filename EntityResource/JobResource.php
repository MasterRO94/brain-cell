<?php

namespace Brain\Cell\EntityResource;

use Brain\Cell\Transfer\AbstractResource;

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
     * @var ProductionHouseResource
     */
    protected $productionHouse;

    /**
     * @var ShopResource
     */
    protected $shop;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'productionHouse' => ProductionHouseResource::class,
            'shop' => ShopResource::class
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

}
