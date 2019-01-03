<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Product;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class ProductResource extends AbstractResource implements ResourceIdentityInterface
{
    use ResourceIdentityTrait;

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
