<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Stock\Finishing;

use Brain\Cell\EntityResource\Prototype\ResourceAliasTrait;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class FinishingItemResource extends AbstractResource implements
    FinishingItemResourceInterface
{
    use ResourceIdentityTrait;
    use ResourceAliasTrait;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    protected $alias;

    /** @var string */
    protected $name;

    /** @var int */
    protected $weight;

    /** @var string */
    protected $weightUnit;

    /** @var bool */
    protected $isDefault;

    /** @var bool */
    protected $configurable;

    /** @var mixed[] */
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
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the human-readable name.
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function isDefault(): bool
    {
        return $this->isDefault;
    }

    public function setIsDefault(bool $isDefault): void
    {
        $this->isDefault = $isDefault;
    }

    public function isConfigurable(): bool
    {
        return $this->configurable;
    }

    public function setConfigurable(bool $configurable): void
    {
        $this->configurable = $configurable;
    }

    /**
     * @return mixed[]
     */
    public function getConfiguration(): array
    {
        return $this->configuration;
    }

    /**
     * @param mixed[] $configuration
     */
    public function setConfiguration(array $configuration): void
    {
        $this->configuration = $configuration;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;
    }

    public function getWeightUnit(): string
    {
        return $this->weightUnit;
    }

    public function setWeightUnit(string $weightUnit): self
    {
        $this->weightUnit = $weightUnit;
    }
}
