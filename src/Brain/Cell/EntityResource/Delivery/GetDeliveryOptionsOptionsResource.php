<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\Transfer\AbstractResource;

use DateTime;

/**
 * A class representing the $options field in the GetDeliveryOptionsArgs class.
 */
class GetDeliveryOptionsOptionsResource extends AbstractResource
{
    /** @var DateTime|null */
    protected $minimalDeliveryOptionsLifetime;

    /** @var bool */
    protected $fastGenerationRoutine;

    /** @var bool */
    protected $fallbackDeliveryOptionOnly;

    /** @var string */
    protected $primaryProductionHouse;

    public function setMinimalDeliveryOptionsLifetime(?DateTime $minimalDeliveryOptionsLifetime): void
    {
        $this->minimalDeliveryOptionsLifetime = $minimalDeliveryOptionsLifetime;
    }

    public function setFastGenerationRoutine(bool $fastGenerationRoutine): void
    {
        $this->fastGenerationRoutine = $fastGenerationRoutine;
    }

    public function setFallbackDeliveryOptionOnly(bool $fallbackDeliveryOptionOnly): void
    {
        $this->fallbackDeliveryOptionOnly = $fallbackDeliveryOptionOnly;
    }

    public function setPrimaryProductionHouse(string $productionHouseId): void
    {
        $this->primaryProductionHouse = $productionHouseId;
    }
}
