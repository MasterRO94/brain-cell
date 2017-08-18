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
