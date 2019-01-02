<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\EntityResource\ThreeDimensionalResource;
use Brain\Cell\Transfer\AbstractResource;

class DispatchParcelResource extends AbstractResource
{
    /** @var string */
    protected $id;

    /** @var ThreeDimensionalResource $dimensions */
    protected $dimensions;

    /** @var int $weight */
    protected $weight;

    /** @var DispatchResource $dispatch */
    protected $dispatch;

    /** @var string $postageLabelUrl */
    protected $postageLabelUrl;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'dispatch' => DispatchResource::class,
            'dimensions' => ThreeDimensionalResource::class,
        ];
    }

    public function getDimensions(): ThreeDimensionalResource
    {
        return $this->dimensions;
    }

    public function setDimensions(ThreeDimensionalResource $dimensions): void
    {
        $this->dimensions = $dimensions;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    public function getDispatch(): DispatchResource
    {
        return $this->dispatch;
    }

    public function setDispatch(DispatchResource $dispatch): void
    {
        $this->dispatch = $dispatch;
    }

    public function getPostageLabelUrl(): string
    {
        return $this->postageLabelUrl;
    }

    public function setPostageLabelUrl(string $postageLabelUrl): void
    {
        $this->postageLabelUrl = $postageLabelUrl;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }
}
