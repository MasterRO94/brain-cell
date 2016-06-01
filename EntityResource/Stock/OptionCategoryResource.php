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
    protected $name;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return OptionCategoryResource
     */
    public function setName($name)
    {
        $this->name = $name;
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
