<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Artwork\ArtworkResource;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\EntityResource\Stock\MaterialResource;
use Brain\Cell\EntityResource\Stock\MaterialResourceInterface;
use Brain\Cell\EntityResource\Stock\SizeResource;
use Brain\Cell\EntityResource\StockDefinitionResource;
use Brain\Cell\EntityResource\TwoDimensionalResource;
use Brain\Cell\Logical\Dimension\TwoDimensionalInterface;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class JobComponentResource extends AbstractResource implements
    JobComponentResourceInterface
{
    use ResourceIdentityTrait;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     */
    protected $rangeStart;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     */
    protected $rangeEnd;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     */
    protected $productionSheetCount;

    /**
     * @var JobComponentOptionResource[]|ResourceCollection
     *
     * @Assert\Valid()
     * @Assert\Expression(
     *     expression="this.getOptions() && this.getOptions().count() > 0",
     *     message="There must be options specified for the component"
     * )
     */
    protected $options;

    /**
     * @var SizeResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $size;

    /** @var StockDefinitionResource */
    protected $stockDefinition;

    /**
     * @var MaterialResourceInterface
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $material;

    /**
     * @var TwoDimensionalInterface
     *
     * @Assert\Valid()
     */
    protected $dimensions;

    /** @var int */
    protected $weight;

    /** @var string */
    protected $label;

    /**
     * @var ArtworkResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $artwork;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'size' => SizeResource::class,
            'material' => MaterialResource::class,
            'dimensions' => TwoDimensionalResource::class,
            'stockDefinition' => StockDefinitionResource::class,
            'artwork' => ArtworkResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections(): array
    {
        return [
            'options' => JobComponentOptionResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions(): ResourceCollection
    {
        return $this->options;
    }

    /**
     * Set the job component level options.
     *
     * @param JobComponentOptionResourceInterface[]|ResourceCollection $options
     */
    public function setOptions(ResourceCollection $options): void
    {
        $this->options = $options;
    }

    /**
     * {@inheritdoc}
     */
    public function getRangeStart(): int
    {
        return $this->rangeStart;
    }

    public function setRangeStart(int $rangeStart): void
    {
        $this->rangeStart = $rangeStart;
    }

    /**
     * {@inheritdoc}
     */
    public function getRangeEnd(): int
    {
        return $this->rangeEnd;
    }

    public function setRangeEnd(int $rangeEnd): void
    {
        $this->rangeEnd = $rangeEnd;
    }

    public function getArtwork(): ArtworkResource
    {
        return $this->artwork;
    }

    public function setArtwork(ArtworkResource $artwork): void
    {
        $this->artwork = $artwork;
    }

    public function getSize(): SizeResource
    {
        return $this->size;
    }

    public function setSize(SizeResource $size): void
    {
        $this->size = $size;
    }

    public function getStockDefinition(): StockDefinitionResource
    {
        return $this->stockDefinition;
    }

    /**
     * {@inheritdoc}
     */
    public function getMaterial(): MaterialResourceInterface
    {
        return $this->material;
    }

    /**
     * Set the component material.
     */
    public function setMaterial(MaterialResourceInterface $material): void
    {
        $this->material = $material;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    public function getProductionSheetCount(): int
    {
        return $this->productionSheetCount;
    }

    public function setProductionSheetCount(int $productionSheetCount): void
    {
        $this->productionSheetCount = $productionSheetCount;
    }

    public function getSizeCountPerMaterial(): int
    {
        $width = $this->getDimensions()->getWidth();
        $height = $this->getDimensions()->getHeight();
        $sra3Width = 450;
        $sra3Height = 320;

        return (int) floor(
            ($sra3Height * $sra3Width) / ($width * $height)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDimensions(): TwoDimensionalInterface
    {
        return $this->dimensions;
    }

    public function setDimensions(TwoDimensionalInterface $dimensions): void
    {
        $this->dimensions = $dimensions;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }
}
