<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Product;

use Brain\Cell\EntityResource\Stock\FinishingItemResource;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class ProductFinishingAssignmentResource extends AbstractResource
{
    /** @var ProductResource */
    protected $product;

    /** @var FinishingItemResource */
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

    public function getProduct(): ProductResource
    {
        return $this->product;
    }

    public function setProduct(ProductResource $product): void
    {
        $this->product = $product;
    }

    public function getStockFinishingItem(): FinishingItemResource
    {
        return $this->stockFinishingItem;
    }

    public function setStockFinishingItem(FinishingItemResource $stockFinishingItem): void
    {
        $this->stockFinishingItem = $stockFinishingItem;
    }
}
