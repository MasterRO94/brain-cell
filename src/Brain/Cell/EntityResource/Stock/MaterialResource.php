<?php

namespace Brain\Cell\EntityResource\Stock;

use Brain\Cell\EntityResource\Stock\Material\MaterialBaseResource;
use Brain\Cell\EntityResource\Stock\Material\MaterialVariantResource;
use Brain\Cell\EntityResource\Stock\Material\MaterialWeightResource;
use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class MaterialResource extends AbstractResource
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
            'weight' => MaterialWeightResource::class,
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
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     *
     * @return MaterialResource
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
     * @return MaterialResource
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
    public function setWeight(MaterialWeightResource $weight)
    {
        $this->weight = $weight;

        return $this;
    }
}
