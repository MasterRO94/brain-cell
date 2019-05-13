<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Country\AddressResourceInterface;
use Brain\Cell\TransferEntityInterface;

// @todo make interfaces for these
use Brain\Cell\EntityResource\Delivery\ProductionStrategyResource;
use Brain\Cell\EntityResource\Delivery\DeliveryServiceResource;
use Brain\Cell\EntityResource\Common\DateResource;

interface JobBatchBatchDeliveryResourceInterface extends TransferEntityInterface
{
    public function getDeliveryAddress(): ?AddressResourceInterface;

    public function getProductionStrategy(): ?ProductionStrategyResource;

    public function getDeliveryService(): ?DeliveryServiceResource;

    public function getAssumedStartOfProductionDate(): ?DateResource;

    public function getEndOfProductionDate(): ?DateResource;

    public function getDeliveryCollectionDate(): ?DateResource;

    public function getDeliveryDateEarliest(): ?DateResource;

    public function getDeliveryDateLatest(): ?DateResource;

    public function getDeliveryTimeFrameEarliest(): ?string;

    public function getDeliveryTimeFrameLatest(): ?string;
}
