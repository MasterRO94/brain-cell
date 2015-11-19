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
        $instance->id = $id;
        $instance->name = $name;
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}
