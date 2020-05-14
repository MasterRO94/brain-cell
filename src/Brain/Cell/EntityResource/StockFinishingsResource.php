<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource;

use Brain\Cell\EntityResource\Stock\AvailabilityResource;
use Brain\Cell\EntityResource\Stock\Finishing\FinishingCategoryResource;
use Brain\Cell\EntityResource\Stock\MaterialResource;
use Brain\Cell\EntityResource\Stock\SizeResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

/**
 * {@inheritdoc}
 */
class StockFinishingsResource extends AbstractResource
{
    /** @var AvailabilityResource[]|ResourceCollection */
    protected $availability;

    /** @var FinishingCategoryResource[]|ResourceCollection */
    protected $finishings;

    /** @var MaterialResource[]|ResourceCollection */
    protected $materials;

    /** @var ResourceCollection|SizeResource[] */
    protected $sizes;

    /** ClientResource[]|ResourceCollection */
    protected $productionHouses;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections(): array
    {
        return [
            'availability' => AvailabilityResource::class,
            'finishings' => FinishingCategoryResource::class,
            'materials' => MaterialResource::class,
            'sizes' => SizeResource::class,
            'productionHouses' => ClientResource::class,
        ];
    }

    /**
     * @return AvailabilityResource[]|ResourceCollection
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * @return FinishingCategoryResource[]|ResourceCollection
     */
    public function getFinishings()
    {
        return $this->finishings;
    }

    /**
     * @return MaterialResource[]|ResourceCollection
     */
    public function getMaterials()
    {
        return $this->materials;
    }

    /**
     * @return ResourceCollection|SizeResource[]
     */
    public function getSizes()
    {
        return $this->sizes;
    }
}
