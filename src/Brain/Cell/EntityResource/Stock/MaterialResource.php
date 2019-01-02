<?php

declare(strict_types=1);

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
    /** @var string */
    protected $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     */
    protected $alias;

    /** @var string */
    protected $name;

    /** @var MaterialBaseResource */
    protected $base;

    /** @var MaterialVariantResource */
    protected $variant;

    /** @var MaterialWeightResource */
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

    public function getId(): string
    {
        return $this->id;
    }

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

    public function getBase(): MaterialBaseResource
    {
        return $this->base;
    }

    public function setBase(MaterialBaseResource $base): void
    {
        $this->base = $base;
    }

    public function getVariant(): MaterialVariantResource
    {
        return $this->variant;
    }

    public function setVariant(MaterialVariantResource $variant): void
    {
        $this->variant = $variant;
    }

    public function getWeight(): MaterialWeightResource
    {
        return $this->weight;
    }

    public function setWeight(MaterialWeightResource $weight): void
    {
        $this->weight = $weight;
    }
}
