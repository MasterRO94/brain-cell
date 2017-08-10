<?php
/**
 * @maintainer Alex Moon <alex.moon@printed.com>
 */

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\AddressResource;
use Brain\Cell\EntityResource\Delivery\DeliveryResource;
use Brain\Cell\EntityResource\Dispatch\DispatchResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

class JobBatchResource extends AbstractResource
{

    /**
     * @var string
     */
    protected $id;

    /**
     * @var DeliveryResource
     */
    protected $delivery;

    /**
     * @var AddressResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $address;

    /**
     * @var ResourceCollection|JobResource[]
     *
     * @Assert\Valid()
     * @Assert\Expression(
     *     expression="this.getJobs() && this.getJobs().count() > 0",
     *     message="There must be jobs specified for the batch"
     * )
     */
    protected $jobs;

    /**
     * @var ResourceCollection|DispatchResource[]
     *
     * @Assert\Valid()
     */
    protected $dispatches;


    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'delivery' => DeliveryResource::class,
            'address' => AddressResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'jobs' => JobResource::class,
            'dispatches' => DispatchResource::class,
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

    /**
     * {@inheritdoc}
     *
     * @return AddressResource
     */
    public function getAddress(): AddressResource
    {
        return $this->address;
    }

    /**
     * {@inheritdoc}
     *
     * @param AddressResource $address
     */
    public function setAddress(AddressResource $address)
    {
        $this->address = $address;
    }

    /**
     * @return JobResource[]|ResourceCollection
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    /**
     * @param JobResource[]|ResourceCollection $jobs
     */
    public function setJobs($jobs)
    {
        $this->jobs = $jobs;
    }

    /**
     * @param DispatchResource[]|ResourceCollection $dispatches
     */
    public function setDispatches($dispatches)
    {
        $this->dispatches = $dispatches;
    }

    /**
     * @return DispatchResource[]|ResourceCollection
     */
    public function getDispatches()
    {
        return $this->dispatches;
    }

    /**
     * @param DispatchResource $dispatch
     */
    public function addDispatch($dispatch)
    {
        $this->dispatches->add($dispatch);
        $dispatch->setJobBatch($this);
    }

}
