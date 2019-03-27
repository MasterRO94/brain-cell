<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Common\Status;

use Brain\Cell\TransferEntityInterface;

interface StatusTransitionResourceInterface extends
    TransferEntityInterface
{
    /**
     * Return the status canonical.
     */
    public function getCanonical(): string;

    /**
     * Return the status transition reason.
     */
    public function getReason(): ?string;

    /**
     * Check if the status is active.
     *
     * This field is only populated when receiving the list of transitions.
     * Otherwise expect this method to return null in all other cases.
     */
    public function isActive(): ?bool;
}
