<?php

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\EntityResource\AddressResource;
use Brain\Cell\Transfer\AbstractResource;

use Palm\Bundle\Core\Logical\IdentityTrait;
use Symfony\Component\Validator\Constraints as Assert;

class DeliveryAddressResource extends AbstractResource
{
    use IdentityTrait;

    /** @var AddressResource $address */
    protected $address;

    public function getAssociatedResources()
    {
        return [
            'address' => AddressResource::class,
        ];
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     * @return DeliveryAddressResource
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }
}
