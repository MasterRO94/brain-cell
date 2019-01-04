<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\ClientResource;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\TransferEntityInterface;

/**
 * A job note.
 */
interface JobNoteResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface
{
    /**
     * Return the note canonical type.
     */
    public function getCanonical(): string;

    /**
     * Return the note summary.
     */
    public function getSummary(): string;

    /**
     * Return the note contents.
     */
    public function getDescription(): string;

    /**
     * Return the note originating client.
     */
    public function getOrigin(): ClientResource;
}
