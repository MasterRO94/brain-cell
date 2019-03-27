<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Product;

use Brain\Cell\EntityResource\Stock\SizeResource;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class ProductSizeAssignmentResource extends AbstractResource
{
    /** @var ProductResource */
    protected $product;

    /** @var SizeResource */
    protected $stockSize;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'product' => ProductResource::class,
            'stockSize' => SizeResource::class,
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

    public function getStockSize(): SizeResource
    {
        return $this->stockSize;
    }

    public function setStockSize(SizeResource $stockSize): void
    {
        $this->stockSize = $stockSize;
    }
}
