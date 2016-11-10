<?php

namespace Brain\Cell\EntityResource;

use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class ProductionHouseResource extends AbstractResource
{

    /**
     * @var int
     */
    protected $id;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ProductionHouseResource
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

}
