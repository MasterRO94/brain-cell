<?php

namespace Brain\Cell\EntityResource\Stock;

use Brain\Cell\EntityResource\Stock\Material\MaterialBaseResource;
use Brain\Cell\EntityResource\Stock\Material\MaterialVariantResource;
use Brain\Cell\EntityResource\Stock\Material\MaterialWeightResource;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class MaterialResource extends AbstractResource
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    protected $alias;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var MaterialBaseResource
     */
    protected $base;

    /**
     * @var MaterialVariantResource
     */
    protected $variant;

    /**
     * @var MaterialWeightResource
     */
    protected $weight;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'base' => MaterialBaseResource::class,
            'variant' => MaterialVariantResource::class,
            'weight' => MaterialWeightResource::class
        ];
    }

    /**
     * @return int
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
     * @return FinishingItemResource
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
     * @return FinishingItemResource
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return MaterialBaseResource
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * @param MaterialBaseResource $base
     *
     * @return MaterialResource
     */
    public function setBase(MaterialBaseResource $base)
    {
        $this->base = $base;
        return $this;
    }

    /**
     * @return MaterialVariantResource
     */
    public function getVariant()
    {
        return $this->variant;
    }

    /**
     * @param MaterialVariantResource $variant
     *
     * @return MaterialResource
     */
    public function setVariant(MaterialVariantResource $variant)
    {
        $this->variant = $variant;
        return $this;
    }

    /**
     * @return MaterialWeightResource
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param MaterialWeightResource $weight
     *
     * @return MaterialResource
     */
    public function setWeight(MaterialWeightResource $weight): MaterialResource
    {
        $this->weight = $weight;
        return $this;
    }

}
