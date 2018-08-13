<?php

namespace Brain\Cell\EntityResource\Product;

use Brain\Cell\EntityResource\Stock\FinishingItemResource;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class ProductFinishingAssignmentResource extends AbstractResource
{
    /**
     * @var ProductResource
     */
    protected $product;

    /**
     * @var FinishingItemResource
     */
    protected $stockFinishingItem;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'product' => ProductResource::class,
            'stockFinishingItem' => FinishingItemResource::class,
        ];
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
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return FinishingItemResource
     */
    public function getStockFinishingItem()
    {
        return $this->stockFinishingItem;
    }

    /**
     * @param FinishingItemResource $stockFinishingItem
     */
    public function setStockFinishingItem($stockFinishingItem)
    {
        $this->stockFinishingItem = $stockFinishingItem;
    }
}
