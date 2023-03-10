<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Stock\Finishing;

use Brain\Cell\EntityResource\Prototype\ResourceAliasTrait;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
final class FinishingItemResource extends AbstractResource implements
    FinishingItemResourceInterface
{
    use ResourceIdentityTrait;
    use ResourceAliasTrait;

    /** @var string */
    protected $name;

    /** @var int */
    protected $weight;

    /** @var string */
    protected $weightUnit;

    /** @var bool */
    protected $isDefault = false;

    /** @var bool */
    protected $configurable;

    /** @var bool */
    protected $isArtworkRequired;

    /** @var string[] */
    protected $artworkLabels;

    /** @var mixed[] */
    protected $configuration;

    /** @var FinishingCategoryResource */
    protected $category;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'category' => FinishingCategoryResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getUnstructuredFields(): array
    {
        return [
            'configuration',
            'artworkLabels',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the human-readable name.
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function isDefault(): bool
    {
        return $this->isDefault;
    }

    public function setIsDefault(bool $isDefault): void
    {
        $this->isDefault = $isDefault;
    }

    /**
     * {@inheritdoc}
     */
    public function isArtworkRequired(): bool
    {
        return $this->isArtworkRequired;
    }

    public function setIsArtworkRequired(bool $isArtworkRequired): void
    {
        $this->isArtworkRequired = $isArtworkRequired;
    }

    /**
     * {@inheritdoc}
     */
    public function getArtworkLabels(): array
    {
        return $this->artworkLabels;
    }

    /**
     * @param string[] $artworkLabels
     */
    public function setArtworkLabels(array $artworkLabels): void
    {
        $this->artworkLabels = $artworkLabels;
    }

    /**
     * {@inheritdoc}
     */
    public function isConfigurable(): bool
    {
        return $this->configurable;
    }

    public function setConfigurable(bool $configurable): void
    {
        $this->configurable = $configurable;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration(): array
    {
        return $this->configuration;
    }

    /**
     * @param mixed[] $configuration
     */
    public function setConfiguration(array $configuration): void
    {
        $this->configuration = $configuration;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    public function getWeightUnit(): string
    {
        return $this->weightUnit;
    }

    public function setWeightUnit(string $weightUnit): void
    {
        $this->weightUnit = $weightUnit;
    }

    public function getCategory(): FinishingCategoryResource
    {
        return $this->category;
    }

    public function setCategory(FinishingCategoryResource $category): void
    {
        $this->category = $category;
    }
}
