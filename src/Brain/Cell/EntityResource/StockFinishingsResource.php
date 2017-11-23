<?php

namespace Brain\Cell\EntityResource;

use Brain\Cell\EntityResource\Stock\FinishingCategoryResource;
use Brain\Cell\EntityResource\Stock\MaterialResource;
use Brain\Cell\EntityResource\Stock\SizeResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

/**
 * {@inheritdoc}
 */
class StockFinishingsResource extends AbstractResource
{
    /**
     * @var ResourceCollection|FinishingCategoryResource[]
     */
    protected $finishings;

    /**
     * @var ResourceCollection|MaterialResource[]
     */
    protected $materials;

    /**
     * @var ResourceCollection|SizeResource[]
     */
    protected $sizes;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'finishings' => FinishingCategoryResource::class,
            'materials' => MaterialResource::class,
            'sizes' => SizeResource::class,
        ];
    }

    /**
     * @return ResourceCollection|FinishingCategoryResource[]
     */
    public function getFinishings()
    {
        return $this->finishings;
    }

    /**
     * @return ResourceCollection|MaterialResource[]
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
