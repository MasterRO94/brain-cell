<?php

namespace Brain\Cell\EntityResource\Stock;

use Brain\Cell\Transfer\AbstractResource;

class FinishingRepository extends AbstractResource
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
     * @return FinishingRepository
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
     * @return FinishingRepository
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

}
