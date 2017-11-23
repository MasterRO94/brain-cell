<?php

namespace Brain\Cell\EntityResource\Stock\Material;

use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class MaterialBaseResource extends AbstractResource
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    protected $alias;

    /**
     * @var string
     */
    protected $name;

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
     *
     * @return FinishingItemResource
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
     *
     * @return FinishingItemResource
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
