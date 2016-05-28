<?php

namespace Brain\Cell\EntityResource\Stock;

use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

/**
 * {@inheritdoc}
 */
class OptionCategoryResource extends AbstractResource
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
     * @var OptionResource[]
     */
    protected $options = [];

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'options' => OptionResource::CLASS
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
     * @return OptionCategoryResource
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
     * @return OptionCategoryResource
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return ResourceCollection|OptionResource[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param ResourceCollection|OptionResource[] $options
     * @return OptionCategoryResource
     */
    public function setOptions(ResourceCollection $options)
    {
        $this->options = $options;
        return $this;
    }

}
