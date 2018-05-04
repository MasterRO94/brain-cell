<?php

namespace Brain\Cell\EntityResource\Stock;

use Brain\Cell\EntityResource\TwoDimensionalResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

class FinishingCombinationResource extends AbstractResource
{
    protected $stockDefinition;

    /**
     * @var FinishingCombinationAssignmentResource[]|ResourceCollection
     */
    protected $assignments;

    /**
     * @var MaterialResource
     */
    protected $stockMaterial;

    /**
     * @var TwoDimensionalResource
     */
    protected $minimumDimension;

    /**
     * @var TwoDimensionalResource
     */
    protected $maximumDimension;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'minimumDimension' => TwoDimensionalResource::class,
            'maximumDimension' => TwoDimensionalResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
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
    public function setStockDefinition($stockDefinition)
    {
        $this->stockDefinition = $stockDefinition;
    }

    /**
     * @return MaterialResource
     */
    public function getStockMaterial()
    {
        return $this->stockMaterial;
    }

    /**
     * @param MaterialResource $stockMaterial
     */
    public function setStockMaterial(MaterialResource $stockMaterial)
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
    public function setAssignments($assignments)
    {
        $this->assignments = $assignments;
    }

    /**
     * @return TwoDimensionalResource
     */
    public function getMinimumDimension()
    {
        return $this->minimumDimension;
    }

    /**
     * @param TwoDimensionalResource $minimumDimension
     */
    public function setMinimumDimension(TwoDimensionalResource $minimumDimension)
    {
        $this->minimumDimension = $minimumDimension;
    }

    /**
     * @return TwoDimensionalResource
     */
    public function getMaximumDimension()
    {
        return $this->maximumDimension;
    }

    /**
     * @param TwoDimensionalResource $maximumDimension
     */
    public function setMaximumDimension(TwoDimensionalResource $maximumDimension)
    {
        $this->maximumDimension = $maximumDimension;
    }
}
