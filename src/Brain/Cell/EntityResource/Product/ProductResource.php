<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Product;

use Brain\Cell\EntityResource\Interfaces\ResourcePublicIdInterface;
use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class ProductResource extends AbstractResource implements ResourcePublicIdInterface
{
    use ResourcePublicIdTrait;

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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getChangeSet(): ?ChangeSetResource
    {
        return $this->changeSet;
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
