<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\ClientResource;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\Prototype\Column\Date\CreatedAtInterface;
use Brain\Cell\TransferEntityInterface;

/**
 * A job note.
 */
interface JobNoteResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface,
    CreatedAtInterface
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

    /**
     * @return mixed[]
     */
    public function getMetaData(): array;
}
