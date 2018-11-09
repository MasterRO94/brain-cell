<?php

namespace Brain\Cell\EntityResource\Stock;

use Brain\Cell\EntityResource\Interfaces\ResourcePublicIdInterface;
use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class FinishingItemResource extends AbstractResource implements ResourcePublicIdInterface
{
    use ResourcePublicIdTrait;

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
    protected $isDefault;

    /**
     * @var bool
     */
    protected $configurable;

    /**
     * @var array
     */
    protected $configuration;

    /**
     * {@inheritdoc}
     */
    public function getUnstructuredFields(): array
    {
        return [
            'configuration',
        ];
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
        return $this->isDefault;
    }

    /**
     * @param bool $isDefault
     */
    public function setIsDefault(bool $isDefault)
    {
        $this->isDefault = $isDefault;
    }

    /**
     * @return bool
     */
    public function isConfigurable()
    {
        return $this->configurable;
    }

    /**
     * @param bool $configurable
     */
    public function setConfigurable(bool $configurable)
    {
        $this->configurable = $configurable;
    }

    /**
     * @return array
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @param array $configuration
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
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
     *
     * @return FinishingItemResource
     */
    public function setWeight(int $weight): self
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
     *
     * @return FinishingItemResource
     */
    public function setWeightUnit(string $weightUnit): self
    {
        $this->weightUnit = $weightUnit;

        return $this;
    }
}
