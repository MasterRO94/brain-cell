<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Artwork\ArtworkResource;
use Brain\Cell\EntityResource\Stock\MaterialResource;
use Brain\Cell\EntityResource\Stock\SizeResource;
use Brain\Cell\EntityResource\StockDefinitionResource;
use Brain\Cell\EntityResource\TwoDimensionalResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class JobComponentResource extends AbstractResource
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $status;

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

    /**
     * @var StockDefinitionResource
     */
    protected $stockDefinition;

    /**
     * @var MaterialResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $material;

    /**
     * @var TwoDimensionalResource
     *
     * @Assert\Valid()
     */
    protected $dimensions;

    /**
     * @var int
     */
    protected $weight;

    /**
     * @var string
     */
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
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return JobComponentOptionResource[]|ResourceCollection
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param JobComponentOptionResource[]|ResourceCollection $options
     *
     * @return JobComponentResource
     */
    public function setOptions(ResourceCollection $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int
     */
    public function getRangeStart()
    {
        return $this->rangeStart;
    }

    /**
     * @param int $rangeStart
     *
     * @return JobComponentResource
     */
    public function setRangeStart($rangeStart)
    {
        $this->rangeStart = $rangeStart;

        return $this;
    }

    /**
     * @return int
     */
    public function getRangeEnd()
    {
        return $this->rangeEnd;
    }

    /**
     * @param int $rangeEnd
     *
     * @return JobComponentResource
     */
    public function setRangeEnd($rangeEnd)
    {
        $this->rangeEnd = $rangeEnd;

        return $this;
    }

    /**
     * @return ArtworkResource
     */
    public function getArtwork()
    {
        return $this->artwork;
    }

    /**
     * @param ArtworkResource $artwork
     *
     * @return JobComponentResource
     */
    public function setArtwork(ArtworkResource $artwork)
    {
        $this->artwork = $artwork;
    }

    /**
     * @return SizeResource
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param SizeResource $size
     *
     * @return JobComponentResource
     */
    public function setSize(SizeResource $size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return StockDefinitionResource
     */
    public function getStockDefinition()
    {
        return $this->stockDefinition;
    }

    /**
     * @return MaterialResource
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * @param MaterialResource $material
     *
     * @return JobComponentResource
     */
    public function setMaterial(MaterialResource $material)
    {
        $this->material = $material;

        return $this;
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     *
     * @return JobComponentResource
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return int
     */
    public function getProductionSheetCount()
    {
        return $this->productionSheetCount;
    }

    /**
     * @param int $productionSheetCount
     */
    public function setProductionSheetCount(int $productionSheetCount)
    {
        $this->productionSheetCount = $productionSheetCount;
    }

    /**
     * @todo stub - this will be calculated in Brain based on size and material
     *
     * @return int
     */
    public function getSizeCountPerMaterial()
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
     * @return TwoDimensionalResource
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * @param TwoDimensionalResource $dimensions
     */
    public function setDimensions(TwoDimensionalResource $dimensions)
    {
        $this->dimensions = $dimensions;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }
}
