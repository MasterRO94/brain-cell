<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Product;

use Brain\Cell\EntityResource\Stock\MaterialResource;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class ProductMaterialAssignmentResource extends AbstractResource
{
    /** @var ProductResource */
    protected $product;

    /** @var MaterialResource */
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

    public function getProduct(): ProductResource
    {
        return $this->product;
    }

    public function setProduct(ProductResource $product): void
    {
        $this->product = $product;
    }

    public function getStockMaterial(): MaterialResource
    {
        return $this->stockMaterial;
    }

    public function setStockMaterial(MaterialResource $stockMaterial): void
    {
        $this->stockMaterial = $stockMaterial;
    }
}
