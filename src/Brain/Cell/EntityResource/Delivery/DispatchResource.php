<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\EntityResource\Job\JobBatchResource;
use Brain\Cell\EntityResource\Job\JobBatchResourceInterface;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

use Symfony\Component\Validator\Constraints as Assert;

class DispatchResource extends AbstractResource
{
    /** @var string */
    protected $id;

    /**
     * @var JobBatchResourceInterface|null
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $batch;

    /** @var string */
    protected $trackingCode;

    /** @var string */
    protected $labelUrl;

    /** @var DispatchParcelResource[]|ResourceCollection */
    protected $parcels;

    public function __construct()
    {
        $this->parcels = new ResourceCollection();
        $this->parcels->setEntityClass(DispatchParcelResource::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'batch' => JobBatchResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections(): array
    {
        return [
            'parcels' => DispatchParcelResource::class,
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getBatch(): ?JobBatchResourceInterface
    {
        return $this->batch;
    }

    public function setBatch(JobBatchResourceInterface $batch): void
    {
        $this->batch = $batch;
    }

    public function clearBatch(): void
    {
        $this->batch = null;
    }

    public function getTrackingCode(): ?string
    {
        return $this->trackingCode;
    }

    public function setTrackingCode(string $trackingCode): void
    {
        $this->trackingCode = $trackingCode;
    }

    /**
     * @return DispatchParcelResource[]|ResourceCollection
     */
    public function getParcels()
    {
        return $this->parcels;
    }

    /**
     * @param DispatchParcelResource[]|ResourceCollection $parcels
     */
    public function setParcels($parcels): void
    {
        $this->parcels = $parcels;
    }

    public function getLabelUrl(): string
    {
        return $this->labelUrl;
    }

    public function setLabelUrl(string $labelUrl): void
    {
        $this->labelUrl = $labelUrl;
    }
}
