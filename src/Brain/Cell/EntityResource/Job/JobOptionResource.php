<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\EntityResource\Stock\Finishing\FinishingCategoryResource;
use Brain\Cell\EntityResource\Stock\Finishing\FinishingCategoryResourceInterface;
use Brain\Cell\EntityResource\Stock\Finishing\FinishingItemResource;
use Brain\Cell\EntityResource\Stock\Finishing\FinishingItemResourceInterface;
use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

class JobOptionResource extends AbstractResource implements
    JobOptionResourceInterface
{
    use ResourceIdentityTrait;

    /**
     * @var FinishingCategoryResourceInterface
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $finishingCategory;

    /**
     * @var FinishingItemResourceInterface
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $finishingItem;

    /** @var mixed[] */
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
     * {@inheritdoc}
     */
    public function getFinishingCategory(): FinishingCategoryResourceInterface
    {
        return $this->finishingCategory;
    }

    /**
     * Set the finishing category.
     */
    public function setFinishingCategory(FinishingCategoryResourceInterface $finishingCategory): void
    {
        $this->finishingCategory = $finishingCategory;
    }

    /**
     * {@inheritdoc}
     */
    public function getFinishingItem(): FinishingItemResourceInterface
    {
        return $this->finishingItem;
    }

    /**
     * Set the finishing item.
     */
    public function setFinishingItem(FinishingItemResourceInterface $finishingItem): void
    {
        $this->finishingItem = $finishingItem;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration(): array
    {
        return $this->configuration;
    }

    /**
     * Set the finishing configuration.
     *
     * @param mixed[] $configuration
     */
    public function setConfiguration(array $configuration): void
    {
        $this->configuration = $configuration;
    }
}
