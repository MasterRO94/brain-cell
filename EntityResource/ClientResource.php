<?php

namespace Brain\Cell\EntityResource;

use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class ClientResource extends AbstractResource
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
     * @var AddressResource
     */
    protected $address;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $email;


    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'address' => AddressResource::class,
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;

    }

    /**
     * @return AddressResource
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;

    }
}
