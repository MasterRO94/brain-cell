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

/**
 * {@inheritdoc}
 */
class JobComponentOptionResource extends AbstractResource implements
    JobComponentOptionResourceInterface
{
    use ResourceIdentityTrait;

    /**
     * @Assert\Valid()
     * @Assert\NotBlank()
     *
     * @var FinishingCategoryResourceInterface
     */
    protected $finishingCategory;

    /**
     * @Assert\Valid()
     * @Assert\NotBlank()
     *
     * @var FinishingItemResourceInterface
     */
    protected $finishingItem;

    /** @var int|null */
    private $sidesCount;

    /** @var mixed[] */
    protected $configuration;

    public function __construct()
    {
        $this->configuration = [];
    }


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
    public function getSideCount(): int
    {
        if ($this->sidesCount === null) {
            return 0;
        }

        return $this->sidesCount;
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
