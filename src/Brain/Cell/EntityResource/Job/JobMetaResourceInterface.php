<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\TransferEntityInterface;

/**
 * Job meta.
 */
interface JobMetaResourceInterface extends
    TransferEntityInterface
{
    /**
     * Return meta data.
     *
     * @return mixed[]
     */
    public function getData(): array;

    /**
     * Return any job notes.
     */
    public function getNote(): string;
}
