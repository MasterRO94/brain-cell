<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Stock\FinishingCategoryResource;
use Brain\Cell\EntityResource\Stock\FinishingItemResource;
use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class JobPageOptionResource extends AbstractResource
{

    /**
     * @var FinishingCategoryResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $finishingCategory;

    /**
     * @var FinishingItemResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $finishingItem;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'finishingCategory' => FinishingCategoryResource::class,
            'finishingItem' => FinishingItemResource::class
        ];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return FinishingCategoryResource
     */
    public function getFinishingCategory()
    {
        return $this->finishingCategory;
    }

    /**
     * @param FinishingCategoryResource $finishingCategory
     *
     * @return $this
     */
    public function setFinishingCategory(FinishingCategoryResource $finishingCategory)
    {
        $this->finishingCategory = $finishingCategory;
        return $this;
    }

    /**
     * @return FinishingItemResource
     */
    public function getFinishingItem()
    {
        return $this->finishingItem;
    }

    /**
     * @param FinishingItemResource $finishingItem
     *
     * @return $this
     */
    public function setFinishingItem(FinishingItemResource $finishingItem)
    {
        $this->finishingItem = $finishingItem;
        return $this;
    }

}
