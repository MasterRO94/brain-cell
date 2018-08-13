<?php

namespace Brain\Cell\EntityResource\Product;

use Brain\Cell\EntityResource\Stock\SizeResource;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class ProductSizeAssignmentResource extends AbstractResource
{
    /**
     * @var ProductResource
     */
    protected $product;

    /**
     * @var SizeResource
     */
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
     * @return SizeResource
     */
    public function getStockSize()
    {
        return $this->stockSize;
    }

    /**
     * @param SizeResource $stockSize
     */
    public function setStockSize($stockSize)
    {
        $this->stockSize = $stockSize;
    }
}
