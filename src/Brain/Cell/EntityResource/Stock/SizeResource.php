<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Stock;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\EntityResource\TwoDimensionalResource;
use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class SizeResource extends AbstractResource
{
    use ResourceIdentityTrait;

    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     *
     * @var string
     */
    protected $alias;

    /** @var string */
    protected $name;

    /** @var string */
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

    /** @var TwoDimensionalResource */
    protected $dimensions;

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): void
    {
        $this->alias = $alias;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getStockType(): string
    {
        return $this->stockType;
    }

    public function setStockType(string $stockType): void
    {
        $this->stockType = $stockType;
    }

    public function getDimensions(): TwoDimensionalResource
    {
        return $this->dimensions;
    }

    public function setDimensions(TwoDimensionalResource $dimensions): void
    {
        $this->dimensions = $dimensions;
    }
}
