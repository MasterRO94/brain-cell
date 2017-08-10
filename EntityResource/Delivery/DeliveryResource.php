<?php

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\EntityResource\AddressResource;
use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 *
 * @deprecated Potentially temporary.
 */
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
     * @var AddressResource
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
            'address' => AddressResource::class
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
     * @return AddressResource
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param AddressResource $address
     *
     * @return DeliveryResource
     */
    public function setAddress(AddressResource $address)
    {
        $this->address = $address;
        return $this;
    }

}
