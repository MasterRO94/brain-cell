<?php

namespace Brain\Cell\Tests\Mock;

use Brain\Cell\Transfer\AbstractResource;

class SimpleResourceMock extends AbstractResource
{

    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /**
     * @param int $id
     * @param string $name
     * @return static
     */
    public static function create($id, $name)
    {
        $instance = new static;
        $instance->setId($id);
        $instance->setName($name);
        return $instance;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

}
