<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Stock\FinishingCategoryResource;
use Brain\Cell\EntityResource\Stock\FinishingItemResource;
use Brain\Cell\Transfer\AbstractResource;

use Palm\Bundle\Core\Logical\IdentityTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class JobPageOptionResource extends AbstractResource
{
    use IdentityTrait;

    /**
     * @var FinishingCategoryResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $category;

    /**
     * @var FinishingItemResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $item;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'category' => FinishingCategoryResource::class,
            'item' => FinishingItemResource::class
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
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param FinishingCategoryResource $finishingCategory
     *
     * @return $this
     */
    public function setCategory(FinishingCategoryResource $finishingCategory)
    {
        $this->category = $finishingCategory;
        return $this;
    }

    /**
     * @return FinishingItemResource
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param FinishingItemResource $finishingItem
     *
     * @return $this
     */
    public function setItem(FinishingItemResource $finishingItem)
    {
        $this->item = $finishingItem;
        return $this;
    }
}
