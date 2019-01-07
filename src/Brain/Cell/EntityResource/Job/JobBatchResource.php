<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Country\AddressResourceInterface;
use Brain\Cell\EntityResource\Delivery\DeliveryOptionResource;
use Brain\Cell\EntityResource\Delivery\DeliveryOptionResourceInterface;
use Brain\Cell\EntityResource\Delivery\DispatchResource;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * {@inheritdoc}
 */
class JobBatchResource extends AbstractResource implements
    JobBatchResourceInterface
{
    use ResourceIdentityTrait;

    /** @var string */
    protected $status;

    /**
     * @var AddressResourceInterface
     *
     * @deprecated Will be removed very soon. Please update your code. Use the $deliveryOption
     *   in status "incomplete" or the $batchDelivery in statuses past the status "incomplete".
     */
    protected $address;

    /** @var DeliveryOptionResource|null This might be null only in the "incomplete" status */
    protected $deliveryOption;

    /** @var JobBatchBatchDeliveryResource|null This is null only in the "incomplete" status */
    protected $batchDelivery;

    /**
     * @var JobResource[]|ResourceCollection
     *
     * @Assert\Valid()
     * @Assert\Expression(
     *     expression="this.getJobs() && this.getJobs().count() > 0",
     *     message="There must be jobs specified for the batch"
     * )
     */
    protected $jobs;

    /**
     * @var DispatchResource[]|ResourceCollection
     *
     * @Assert\Valid()
     */
    protected $dispatches;

    public function __construct()
    {
        $this->dispatches = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'deliveryOption' => DeliveryOptionResource::class,
            'batchDelivery' => JobBatchBatchDeliveryResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections(): array
    {
        return [
            'jobs' => JobResource::class,
            'dispatches' => DispatchResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getDeliveryOption(): ?DeliveryOptionResourceInterface
    {
        return $this->deliveryOption;
    }

    public function setDeliveryOption(?DeliveryOptionResourceInterface $option): void
    {
        $this->deliveryOption = $option;
    }

    public function getBatchDelivery(): ?JobBatchBatchDeliveryResource
    {
        return $this->batchDelivery;
    }

    public function setBatchDelivery(JobBatchBatchDeliveryResource $batchDelivery): void
    {
        $this->batchDelivery = $batchDelivery;
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
    public function setJobs($jobs): void
    {
        $this->jobs = $jobs;
    }

    /**
     * @param DispatchResource[]|ResourceCollection $dispatches
     */
    public function setDispatches($dispatches): void
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

    public function addDispatch(DispatchResource $dispatch): void
    {
        $this->dispatches->add($dispatch);
        $dispatch->setBatch($this);
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
