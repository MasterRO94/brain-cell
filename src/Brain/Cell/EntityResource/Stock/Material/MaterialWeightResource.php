<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Stock\Material;

use Brain\Cell\EntityResource\Common\Weight\WeightResource;
use Brain\Cell\EntityResource\Common\Weight\WeightResourceInterface;
use Brain\Cell\EntityResource\Prototype\ResourceAliasTrait;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Transfer\AbstractResource;

/**
 * A material weight.
 */
class MaterialWeightResource extends AbstractResource implements
    MaterialWeightResourceInterface
{
    use ResourceIdentityTrait;
    use ResourceAliasTrait;

    /** @var string */
    protected $name;

    /** @var WeightResourceInterface */
    protected $weight;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'weight' => WeightResource::class,
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
     * @deprecated This should not be used, if you are using it for tests mock the interface.
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getWeight(): WeightResourceInterface
    {
        return $this->weight;
    }

    /**
     * @deprecated This should not be used, if you are using it for tests mock the interface.
     */
    public function setWeight(WeightResourceInterface $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @deprecated Will be removed soon, please use getWeight()->getUnit().
     */
    public function getWeightUnit(): string
    {
        return $this->weight->getUnit();
    }
}
