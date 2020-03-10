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

    /** @var ProductGroupResourceInterface|null */
    protected $productGroup;

    /** @var bool */
    protected $isAllowedCustomSizes;

    /** @var ProductCustomSizeRangeResource|null */
    protected $customSizeRange;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'productGroup' => ProductGroupResource::class,
            'customSizeRange' => ProductCustomSizeRangeResource::class,
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

    public function getProductGroup(): ?ProductGroupResourceInterface
    {
        return $this->productGroup;
    }

    public function setProductGroup(ProductGroupResourceInterface $group): void
    {
        $this->productGroup = $group;
    }

    public function isAllowedCustomSizes(): bool
    {
        return $this->isAllowedCustomSizes;
    }

    public function setIsAllowedCustomSizes(bool $isAllowedCustomSizes): void
    {
        $this->isAllowedCustomSizes = $isAllowedCustomSizes;
    }

    /**
     * {@inheritDoc}
     */
    public function getCustomSizeRange(): ?ProductCustomSizeRangeResource
    {
        return $this->customSizeRange;
    }

    public function setCustomSizeRange(ProductCustomSizeRangeResource $customSizeRangeResource): void
    {
        $this->customSizeRange = $customSizeRangeResource;
    }
}
