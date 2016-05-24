<?php

namespace Brain\Cell\EntityResource\Stock;

use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

/**
 * A resource representing an attribute.
 */
class AttributeCategoryRepository extends AbstractResource
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
     * @var AttributeRepository[]
     */
    protected $attributes = [];

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'attributes' => AttributeRepository::CLASS
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
     * @return AttributeCategoryRepository
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
     * @return AttributeCategoryRepository
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return ResourceCollection|AttributeRepository[]
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param ResourceCollection|AttributeRepository[] $attributes
     * @return AttributeCategoryRepository
     */
    public function setAttributes(ResourceCollection $attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

}
