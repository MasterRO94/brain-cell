<?php

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\Transfer\AbstractResource;
use Symfony\Component\Validator\Constraints as Assert;

class DeliveryResource extends AbstractResource
{

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

}
