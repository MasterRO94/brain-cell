<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Stock;

use Brain\Cell\Transfer\AbstractResource;

class FinishingCombinationAssignmentResource extends AbstractResource
{
    /** @var FinishingCategoryResource */
    protected $stockFinishingCategory;

    /** @var FinishingItemResource */
    protected $stockFinishingItem;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'stockFinishingCategory' => FinishingCategoryResource::class,
            'stockFinishingItem' => FinishingItemResource::class,
        ];
    }

    public function getStockFinishingCategory(): FinishingCategoryResource
    {
        return $this->stockFinishingCategory;
    }

    public function setStockFinishingCategory(FinishingCategoryResource $stockFinishingCategory): void
    {
        $this->stockFinishingCategory = $stockFinishingCategory;
    }

    public function getStockFinishingItem(): ?FinishingItemResource
    {
        return $this->stockFinishingItem;
    }

    public function setStockFinishingItem(FinishingItemResource $stockFinishingItem): void
    {
        $this->stockFinishingItem = $stockFinishingItem;
    }
}
