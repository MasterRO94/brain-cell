<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Common;

use Brain\Cell\Transfer\AbstractResource;

/**
 * A common status resource.
 */
abstract class AbstractStatusResource extends AbstractResource
{
    /** @var string */
    protected $canonical;

    /** @var string */
    protected $message;

    /**
     * Return the canonical status string.
     */
    public function getCanonical(): string
    {
        return $this->canonical;
    }

    /**
     * Set the canonical status string.
     */
    public function setCanonical(string $canonical): void
    {
        $this->canonical = $canonical;
    }

    /**
     * Return the localised translation.
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @deprecated To be removed in 2.0, you should never need to set the status.
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}
