<?php
/**
 * @maintainer Alex Moon <alex.moon@printed.com>
 */

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\EntityResource\ThreeDimensionalResource;
use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

class DispatchParcelResource extends AbstractResource
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var ThreeDimensionalResource $dimensions
     */
    protected $dimensions;

    /** @var int $weight */
    protected $weight;

    /** @var DispatchResource $dispatch */
    protected $dispatch;

    /** @var string $postageLabelUrl */
    protected $postageLabelUrl;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'dispatch' => DispatchResource::class,
            'dimensions' => ThreeDimensionalResource::class
        ];
    }

    /**
     * @return ThreeDimensionalResource
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * @param ThreeDimensionalResource $dimensions
     */
    public function setDimensions($dimensions)
    {
        $this->dimensions = $dimensions;
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
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return DispatchResource
     */
    public function getDispatch()
    {
        return $this->dispatch;
    }

    /**
     * @param DispatchResource $dispatch
     */
    public function setDispatch($dispatch)
    {
        $this->dispatch = $dispatch;
    }

    /**
     * @return string
     */
    public function getPostageLabelUrl(): string
    {
        return $this->postageLabelUrl;
    }

    /**
     * @param string $postageLabelUrl
     */
    public function setPostageLabelUrl(string $postageLabelUrl)
    {
        $this->postageLabelUrl = $postageLabelUrl;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}
