<?php

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\Transfer\AbstractResource;
use Symfony\Component\Validator\Constraints as Assert;

class DeliveryResource extends AbstractResource
{

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     */
    protected $customerName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     */
    protected $customerEmail;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     */
    protected $customerPhone;

    /**
     * @var DeliveryAddressResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $address;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'address' => DeliveryAddressResource::class
        ];
    }

    /**
     * @return string
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * @param string $name
     *
     * @return DeliveryResource
     */
    public function setCustomerName($name)
    {
        $this->customerName = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerEmail()
    {
        return $this->customerEmail;
    }

    /**
     * @param string $email
     *
     * @return DeliveryResource
     */
    public function setCustomerEmail($email)
    {
        $this->customerEmail = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerPhone()
    {
        return $this->customerPhone;
    }

    /**
     * @param string $phone
     *
     * @return DeliveryResource
     */
    public function setCustomerPhone($phone)
    {
        $this->customerPhone = $phone;
        return $this;
    }

    /**
     * @return DeliveryAddressResource
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param DeliveryAddressResource $address
     *
     * @return DeliveryResource
     */
    public function setAddress(DeliveryAddressResource $address)
    {
        $this->address = $address;
        return $this;
    }

}
