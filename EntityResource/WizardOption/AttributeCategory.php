<?php

namespace Brain\Cell\EntityResource\WizardOption;

use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

/**
 * A resource representing an attribute.
 */
class AttributeCategory extends AbstractResource
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
     * @var Attribute[]
     */
    protected $attributes = [];

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'attributes' => Attribute::CLASS
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
     * @return Attribute
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
     * @return AttributeCategory
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return ResourceCollection|Attribute[]
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param ResourceCollection|Attribute[] $attributes
     * @return AttributeCategory
     */
    public function setAttributes(ResourceCollection $attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

}
