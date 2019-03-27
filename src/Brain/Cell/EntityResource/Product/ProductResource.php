<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Product;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class ProductResource extends AbstractResource implements
    ProductResourceInterface
{
    use ResourceIdentityTrait;

    /** @var string */
    protected $name;

    /** @var ProductGroupResource|null */
    protected $productGroup;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'productGroup' => ProductGroupResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getProductGroup(): ?ProductGroupResource
    {
        return $this->productGroup;
    }

    public function setProductGroup(ProductGroupResource $productGroup): void
    {
        $this->productGroup = $productGroup;
    }
}
