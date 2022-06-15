<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Country\AddressResourceInterface;
use Brain\Cell\EntityResource\Job\JobBatchResource;
use Brain\Cell\EntityResource\Job\JobBatchResourceInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

use Symfony\Component\Validator\Constraints as Assert;

class DispatchResource extends AbstractResource
{
    use ResourceIdentityTrait;
    use CreatedAtTrait;

    /**
     * @Assert\Valid()
     * @Assert\NotBlank()
     *
     * @var JobBatchResourceInterface|null
     */
    protected $batch;

    /** @var string */
    protected $trackingCode;

    /** @var string */
    protected $trackingPublicUrl;

    /** @var string */
    protected $labelUrl;

    /** @var DispatchParcelResource[]|ResourceCollection */
    protected $parcels;

    /** @var AddressResourceInterface */
    protected $address;

    /** @var DeliveryServiceResource */
    protected $deliveryService;

    /** @var mixed[] */
    protected $metaData;

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
            'createdAt' => DateResource::class,
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

    public function getTrackingPublicUrl(): ?string
    {
        return $this->trackingPublicUrl;
    }

    public function setTrackingPublicUrl(string $trackingPublicUrl): void
    {
        $this->trackingPublicUrl = $trackingPublicUrl;
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

    /**
     * @return AddressResourceInterface|null
     */
    public function getAddress(): ?AddressResourceInterface
    {
        return $this->address;
    }

    /**
     * @param AddressResourceInterface $address
     */
    public function setAddress(AddressResourceInterface $address): void
    {
        $this->address = $address;
    }

    /**
     * @return DeliveryServiceResource|null
     */
    public function getDeliveryService(): ?DeliveryServiceResource
    {
        return $this->deliveryService;
    }

    /**
     * @param DeliveryServiceResource $deliveryService
     */
    public function setDeliveryService(DeliveryServiceResource $deliveryService): void
    {
        $this->deliveryService = $deliveryService;
    }

    /**
     * @return mixed[]
     */
    public function getMetaData(): array
    {
        return $this->metaData;
    }

    /**
     * @param mixed[] $metaData
     */
    public function setMetaData(array $metaData): void
    {
        $this->metaData = $metaData;
    }
}
