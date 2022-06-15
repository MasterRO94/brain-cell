<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\EntityResource\ThreeDimensionalResource;
use Brain\Cell\Transfer\AbstractResource;

class DispatchParcelResource extends AbstractResource
{
    use ResourceIdentityTrait;

    /** @var ThreeDimensionalResource $dimensions */
    protected $dimensions;

    /** @var int $weight */
    protected $weight;

    /** @var DispatchResource $dispatch */
    protected $dispatch;

    /** @var string $postageLabelUrl */
    protected $postageLabelUrl;
    
    /** @var string|null */
    protected $predefinedPackageName;

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

    /**
     * Some delivery service providers allow you to send parcels using a
     * predefined name (e.g. 'Letter') instead of providing the
     * dimensions of the parcel (in some scenarios this can affect the price
     * offered by the delivery service API as it may be configured that
     * the package size provides discount rates in the 3rd party api).
     *
     * If a predefined parcel was used in the dispatch, then this will
     * have a value.
     *
     * Note: it is still required that you provide the dimensions of the parcel,
     * but they would have been ignored if a predefined package name was
     * provided.
     *
     * @return string|null
     */
    public function getPredefinedPackageName(): ?string
    {
        return $this->predefinedPackageName;
    }

    /**
     * @param string|null $predefinedPackageName
     */
    public function setPredefinedPackageName(?string $predefinedPackageName): void
    {
        $this->predefinedPackageName = $predefinedPackageName;
    }
}
