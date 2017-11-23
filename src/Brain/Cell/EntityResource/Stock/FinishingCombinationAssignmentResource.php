<?php

namespace Brain\Cell\EntityResource\Stock;

use Brain\Cell\Transfer\AbstractResource;

class FinishingCombinationAssignmentResource extends AbstractResource
{
    /**
     * @var FinishingCategoryResource
     */
    protected $stockFinishingCategory;

    /**
     * @var FinishingItemResource
     */
    protected $stockFinishingItem;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'stockFinishingCategory' => FinishingCategoryResource::class,
            'stockFinishingItem' => FinishingItemResource::class,
        ];
    }

    /**
     * @return FinishingCategoryResource
     */
    public function getStockFinishingCategory()
    {
        return $this->stockFinishingCategory;
    }

    /**
     * @param FinishingCategoryResource $stockFinishingCategory
     */
    public function setStockFinishingCategory(FinishingCategoryResource $stockFinishingCategory)
    {
        $this->stockFinishingCategory = $stockFinishingCategory;
    }

    /**
     * @return FinishingItemResource|null
     */
    public function getStockFinishingItem()
    {
        return $this->stockFinishingItem;
    }

    /**
     * @param FinishingItemResource $stockFinishingItem
     */
    public function setStockFinishingItem(FinishingItemResource $stockFinishingItem)
    {
        $this->stockFinishingItem = $stockFinishingItem;
    }
}
