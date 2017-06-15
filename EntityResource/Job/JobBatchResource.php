<?php
/**
 * @maintainer Alex Moon <alex.moon@printed.com>
 */

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Delivery\DeliveryResource;
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
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $delivery;

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
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'delivery' => DeliveryResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'jobs' => JobResource::class,
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

}
