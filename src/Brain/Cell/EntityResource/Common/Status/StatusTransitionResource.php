<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Common\Status;

use Brain\Cell\Transfer\AbstractResource;

/**
 * A status transition.
 */
final class StatusTransitionResource extends AbstractResource implements
    StatusTransitionResourceInterface
{
    /** @var string */
    protected $status;

    /** @var string|null */
    protected $reason;

    /** @var bool|null */
    protected $isActive;

    /**
     * {@inheritdoc}
     */
    public function getCanonical(): string
    {
        return $this->status;
    }

    /**
     * Set the status canonical.
     */
    public function setCanonical(string $canonical): void
    {
        $this->status = $canonical;
    }

    /**
     * {@inheritdoc}
     */
    public function getReason(): ?string
    {
        return $this->reason;
    }

    /**
     * Set the reason message.
     */
    public function setReason(?string $reason): void
    {
        $this->reason = $reason;
    }

    /**
     * {@inheritdoc}
     */
    public function isActive(): ?bool
    {
        return $this->isActive;
    }
}
