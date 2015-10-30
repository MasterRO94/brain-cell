<?php

namespace Brain\Cell\Tests\Service\ResourceSerialiserService\Resource;

use Brain\Cell\Transfer\AbstractCollection;
use Brain\Cell\Transfer\AbstractResource;

class SimpleResourceMock extends AbstractResource
{

    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var string */
    protected $reference;

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
     * @return SimpleResourceMock
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return SimpleResourceMock
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

}
