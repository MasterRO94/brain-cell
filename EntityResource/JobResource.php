<?php

namespace Brain\Cell\EntityResource;

use Brain\Cell\EntityResource\Job\WorkflowResource;
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
     * @var int
     */
    protected $status;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'productionHouse' => ProductionHouseResource::class,
            'shop' => ShopResource::class,
            'workflow' => WorkflowResource::class
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

}
