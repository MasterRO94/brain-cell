<?php

namespace Brain\Cell\EntityResource\Product;

use Brain\Cell\EntityResource\Stock\MaterialResource;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class ProductMaterialAssignmentResource extends AbstractResource
{
    /**
     * @var ProductResource
     */
    protected $product;

    /**
     * @var MaterialResource
     */
    protected $stockMaterial;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'product' => ProductResource::class,
            'stockMaterial' => MaterialResource::class,
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
     * @return MaterialResource
     */
    public function getStockMaterial()
    {
        return $this->stockMaterial;
    }

    /**
     * @param MaterialResource $stockMaterial
     */
    public function setStockMaterial($stockMaterial)
    {
        $this->stockMaterial = $stockMaterial;
    }
}
