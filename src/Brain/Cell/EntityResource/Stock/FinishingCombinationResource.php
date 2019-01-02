<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Stock;

use Brain\Cell\EntityResource\TwoDimensionalResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

class FinishingCombinationResource extends AbstractResource
{
    protected $stockDefinition;

    /** @var FinishingCombinationAssignmentResource[]|ResourceCollection */
    protected $assignments;

    /** @var MaterialResource */
    protected $stockMaterial;

    /** @var TwoDimensionalResource */
    protected $minimumDimension;

    /** @var TwoDimensionalResource */
    protected $maximumDimension;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'minimumDimension' => TwoDimensionalResource::class,
            'maximumDimension' => TwoDimensionalResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections(): array
    {
        return [
            'assignments' => FinishingCombinationAssignmentResource::class,
        ];
    }

    /**
     * @return mixed
     */
    public function getStockDefinition()
    {
        return $this->stockDefinition;
    }

    /**
     * @param mixed $stockDefinition
     */
    public function setStockDefinition($stockDefinition): void
    {
        $this->stockDefinition = $stockDefinition;
    }

    public function getStockMaterial(): MaterialResource
    {
        return $this->stockMaterial;
    }

    public function setStockMaterial(MaterialResource $stockMaterial): void
    {
        $this->stockMaterial = $stockMaterial;
    }

    /**
     * @return FinishingCombinationAssignmentResource[]|ResourceCollection
     */
    public function getAssignments()
    {
        return $this->assignments;
    }

    /**
     * @param FinishingCombinationAssignmentResource[]|ResourceCollection $assignments
     */
    public function setAssignments($assignments): void
    {
        $this->assignments = $assignments;
    }

    public function getMinimumDimension(): TwoDimensionalResource
    {
        return $this->minimumDimension;
    }

    public function setMinimumDimension(TwoDimensionalResource $minimumDimension): void
    {
        $this->minimumDimension = $minimumDimension;
    }

    public function getMaximumDimension(): TwoDimensionalResource
    {
        return $this->maximumDimension;
    }

    public function setMaximumDimension(TwoDimensionalResource $maximumDimension): void
    {
        $this->maximumDimension = $maximumDimension;
    }
}
