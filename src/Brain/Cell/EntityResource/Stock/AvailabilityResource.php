<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Stock;

use Brain\Cell\EntityResource\Stock\Finishing\FinishingItemResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

class AvailabilityResource extends AbstractResource
{
    /** @var FinishingItemResource|null */
    protected $disablingFinishing;

    /** @var MaterialResource|null */
    protected $disablingMaterial;

    /** @var SizeResource|null */
    protected $disablingSize;

    /** @var FinishingItemResource[]|ResourceCollection */
    protected $enablingFinishings;

    /** @var MaterialResource[]|ResourceCollection */
    protected $enablingMaterials;

    /** @var SizeResource[]|ResourceCollection */
    protected $enablingSizes;

    /** @var FinishingItemResource[]|ResourceCollection */
    protected $disabledFinishings;

    /** @var MaterialResource[]|ResourceCollection */
    protected $disabledMaterials;

    /** @var SizeResource[]|ResourceCollection */
    protected $disabledSizes;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections(): array
    {
        return [
            'enablingFinishings' => FinishingItemResource::class,
            'enablingMaterials' => MaterialResource::class,
            'enablingSizes' => SizeResource::class,

            'disabledFinishings' => FinishingItemResource::class,
            'disabledMaterials' => MaterialResource::class,
            'disabledSizes' => SizeResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'disablingMaterial' => MaterialResource::class,
            'disablingFinishing' => FinishingItemResource::class,
            'disablingSize' => SizeResource::class,
        ];
    }

    public function getDisablingFinishing(): ?FinishingItemResource
    {
        return $this->disablingFinishing;
    }

    public function getDisablingMaterial(): ?MaterialResource
    {
        return $this->disablingMaterial;
    }

    public function getDisablingSize(): ?SizeResource
    {
        return $this->disablingSize;
    }

    /**
     * @return FinishingItemResource[]|ResourceCollection
     */
    public function getEnablingFinishings()
    {
        return $this->enablingFinishings;
    }

    /**
     * @return MaterialResource[]|ResourceCollection
     */
    public function getEnablingMaterials()
    {
        return $this->enablingMaterials;
    }

    /**
     * @return SizeResource[]|ResourceCollection
     */
    public function getEnablingSizes()
    {
        return $this->enablingSizes;
    }

    /**
     * @return FinishingItemResource[]|ResourceCollection
     */
    public function getDisabledFinishings()
    {
        return $this->disabledFinishings;
    }

    /**
     * @return MaterialResource[]|ResourceCollection
     */
    public function getDisabledMaterials()
    {
        return $this->disabledMaterials;
    }

    /**
     * @return SizeResource[]|ResourceCollection
     */
    public function getDisabledSizes()
    {
        return $this->disabledSizes;
    }
}
