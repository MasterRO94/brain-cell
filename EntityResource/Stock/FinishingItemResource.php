<?php

namespace Brain\Cell\EntityResource\Stock;

use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class FinishingItemResource extends AbstractResource
{

    /**
     * @var string
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
     * @var int
     */
    protected $weight;

    /**
     * @var string
     */
    protected $weightUnit;

    /**
     * @var bool
     */
    protected $default;

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
     * @return bool
     */
    public function isDefault()
    {
        return $this->default;
    }

    /**
     * @param bool $default
     */
    public function setDefault(bool $default)
    {
        $this->default = $default;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     * @return FinishingItemResource
     */
    public function setWeight(int $weight): FinishingItemResource
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return string
     */
    public function getWeightUnit(): string
    {
        return $this->weightUnit;
    }

    /**
     * @param string $weightUnit
     * @return FinishingItemResource
     */
    public function setWeightUnit(string $weightUnit): FinishingItemResource
    {
        $this->weightUnit = $weightUnit;

        return $this;
    }

}
