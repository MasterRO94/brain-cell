<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Production\Status\Helper;

use Brain\Cell\Client\Delegate\Production\Status\ProductionStatusDelegateClient;
use Brain\Cell\EntityResource\Common\AbstractStatusResource;
use Brain\Cell\EntityResource\Common\Status\StatusTransitionResource;
use Brain\Cell\EntityResource\Production\ProductionResourceInterface;
use Brain\Cell\EntityResource\Production\ProductionStatusResource;

/**
 * API client helper for performing production status transition.
 */
final class ProductionStatusTransitionHelper
{
    /** @var ProductionStatusDelegateClient */
    private $delegate;

    public function __construct(ProductionStatusDelegateClient $delegate)
    {
        $this->delegate = $delegate;
    }

    /**
     * Mark the given production as completed.
     */
    public function complete(ProductionResourceInterface $production, ?string $reason): AbstractStatusResource
    {
        $status = ProductionStatusResource::STATUS_COMPLETED;

        return $this->handle($production, $status, $reason);
    }

    /**
     * Mark the given production as cancelled.
     */
    public function cancelled(ProductionResourceInterface $production, ?string $reason): AbstractStatusResource
    {
        $status = ProductionStatusResource::STATUS_CANCELLED;

        return $this->handle($production, $status, $reason);
    }

    /**
     * Handle the transition.
     */
    private function handle(ProductionResourceInterface $production, string $status, ?string $reason): AbstractStatusResource
    {
        $transition = new StatusTransitionResource();
        $transition->setCanonical($status);
        $transition->setReason($reason);

        $resource = $this->delegate->transition($production, $transition);

        return $resource;
    }
}
