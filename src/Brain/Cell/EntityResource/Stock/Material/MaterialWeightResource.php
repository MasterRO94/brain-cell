<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Stock\Material;

use Brain\Cell\EntityResource\Prototype\ResourceAliasTrait;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class MaterialWeightResource extends AbstractResource implements
    MaterialWeightResourceInterface
{
    use ResourceIdentityTrait;
    use ResourceAliasTrait;

    /**
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $alias;

    /** @var string */
    protected $name;

    /** @var int */
    protected $weight;

    /** @var string */
    protected $weightUnit;

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

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    public function getWeightUnit(): string
    {
        return $this->weightUnit;
    }

    public function setWeightUnit(string $weightUnit): void
    {
        $this->weightUnit = $weightUnit;
    }
}
