<?php

namespace Brain\Cell\EntityResource\Stock;

use Brain\Cell\EntityResource\TwoDimensionalResource;
use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class SizeResource extends AbstractResource
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     */
    protected $alias;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $stockType;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'dimensions' => TwoDimensionalResource::class,
        ];
    }

    /**
     * @var TwoDimensionalResource
     */
    protected $dimensions;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     *
     * @return SizeResource
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return SizeResource
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getStockType()
    {
        return $this->stockType;
    }

    /**
     * @param string $stockType
     */
    public function setStockType($stockType)
    {
        $this->stockType = $stockType;
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
     *
     * @return SizeResource
     */
    public function setDimensions(TwoDimensionalResource $dimensions)
    {
        $this->dimensions = $dimensions;

        return $this;
    }
}
