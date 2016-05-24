<?php

namespace Brain\Cell\EntityResource\Stock;

use Brain\Bundle\Stock\Repository\Finishing\FinishingCategoryRepository;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

class FinishingCategoryResource extends AbstractResource
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var FinishingRepository[]
     */
    protected $attributes = [];

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'attributes' => FinishingRepository::CLASS
        ];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return FinishingCategoryResource
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return FinishingCategoryResource
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return ResourceCollection|FinishingRepository[]
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param ResourceCollection|FinishingRepository[] $attributes
     * @return FinishingCategoryRepository
     */
    public function setAttributes(ResourceCollection $attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

}
