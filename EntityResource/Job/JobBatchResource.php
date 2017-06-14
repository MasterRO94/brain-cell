<?php
/**
 * @maintainer Alex Moon <alex.moon@printed.com>
 */

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Delivery\DeliveryResource;
use Brain\Cell\Transfer\AbstractResource;

class JobBatchResource extends AbstractResource
{

    /**
     * @var string
     */
    protected $id;

    /**
     * @var DeliveryResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $delivery;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'delivery' => DeliveryResource::class,
        ];
    }
    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DeliveryResource
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param DeliveryResource $delivery
     *
     * @return JobBatchResource
     */
    public function setDelivery(DeliveryResource $delivery)
    {
        $this->delivery = $delivery;
        return $this;
    }
}
