<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Interfaces\ResourcePublicIdInterface;
use Brain\Cell\EntityResource\Stock\FinishingCategoryResource;
use Brain\Cell\EntityResource\Stock\FinishingItemResource;
use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class JobComponentOptionResource extends AbstractResource implements ResourcePublicIdInterface
{
    use ResourcePublicIdTrait;

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
     * @var array
     */
    protected $configuration;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'finishingCategory' => FinishingCategoryResource::class,
            'finishingItem' => FinishingItemResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getUnstructuredFields(): array
    {
        return [
            'configuration',
        ];
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

    /**
     * @return array
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @param array $configuration
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
    }
}
