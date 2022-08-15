<?php

namespace Brain\Cell\EntityResource\Job\ValueObjectResource;

use Brain\Cell\Transfer\AbstractResource;

/**
 * Options of the JobBatchDelegateClient::updateJobBatchBatchDelivery() api endpoint
 */
class UpdateJobBatchBatchDeliveryActionOptions extends AbstractResource
{
    /** @var bool */
    protected $autoRecalculateDeliveryFinishDates = false;

    public function setAutoRecalculateDeliveryFinishDates(bool $autoRecalculateDeliveryFinishDates): void
    {
        $this->autoRecalculateDeliveryFinishDates = $autoRecalculateDeliveryFinishDates;
    }
}
