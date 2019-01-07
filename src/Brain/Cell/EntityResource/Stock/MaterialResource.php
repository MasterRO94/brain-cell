<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Stock;

use Brain\Cell\EntityResource\Prototype\ResourceAliasTrait;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\EntityResource\Stock\Material\MaterialBaseResource;
use Brain\Cell\EntityResource\Stock\Material\MaterialBaseResourceInterface;
use Brain\Cell\EntityResource\Stock\Material\MaterialVariantResource;
use Brain\Cell\EntityResource\Stock\Material\MaterialVariantResourceInterface;
use Brain\Cell\EntityResource\Stock\Material\MaterialWeightResource;
use Brain\Cell\EntityResource\Stock\Material\MaterialWeightResourceInterface;
use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class MaterialResource extends AbstractResource implements
    MaterialResourceInterface
{
    use ResourceIdentityTrait;
    use ResourceAliasTrait;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     */
    protected $alias;

    /** @var string */
    protected $name;

    /** @var MaterialBaseResourceInterface */
    protected $base;

    /** @var MaterialVariantResourceInterface */
    protected $variant;

    /** @var MaterialWeightResourceInterface */
    protected $weight;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'base' => MaterialBaseResource::class,
            'variant' => MaterialVariantResource::class,
            'weight' => MaterialWeightResource::class,
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

    /**
     * {@inheritdoc}
     */
    public function getBase(): MaterialBaseResourceInterface
    {
        return $this->base;
    }

    /**
     * @deprecated Do not use this, if you are using this for a test then mock the interface.
     */
    public function setBase(MaterialBaseResource $base): void
    {
        $this->base = $base;
    }

    /**
     * {@inheritdoc}
     */
    public function getVariant(): MaterialVariantResourceInterface
    {
        return $this->variant;
    }

    /**
     * @deprecated Do not use this, if you are using this for a test then mock the interface.
     */
    public function setVariant(MaterialVariantResource $variant): void
    {
        $this->variant = $variant;
    }

    /**
     * {@inheritdoc}
     */
    public function getWeight(): MaterialWeightResourceInterface
    {
        return $this->weight;
    }

    /**
     * @deprecated Do not use this, if you are using this for a test then mock the interface.
     */
    public function setWeight(MaterialWeightResource $weight): void
    {
        $this->weight = $weight;
    }
}
