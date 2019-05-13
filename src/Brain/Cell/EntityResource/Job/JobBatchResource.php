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

    /**
     * This might be null only in the "incomplete" status.
     *
     * @var DeliveryOptionResourceInterface|null
     */
    protected $deliveryOption;

    /** @var JobBatchBatchDeliveryResourceInterface|null This is null only in the "incomplete" status */
    protected $batchDelivery;

    /**
     * @var JobResourceInterface[]|ResourceCollection
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
        $this->jobs = new ResourceCollection();
        $this->jobs->setEntityClass(JobResource::class);

        $this->dispatches = new ResourceCollection();
        $this->dispatches->setEntityClass(DispatchResource::class);
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

    public function getBatchDelivery(): ?JobBatchBatchDeliveryResourceInterface
    {
        return $this->batchDelivery;
    }

    public function setBatchDelivery(JobBatchBatchDeliveryResourceInterface $batchDelivery): void
    {
        $this->batchDelivery = $batchDelivery;
    }

    /**
     * {@inheritdoc}
     */
    public function getJobs(): ResourceCollection
    {
        return $this->jobs;
    }

    /**
     * Set the jobs in the batch.
     *
     * @param JobResourceInterface[]|ResourceCollection $jobs
     *
     * @deprecated Unsure if this is allowed, check API endpoints in Brain.
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
