<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Common\AbstractStatusResource;

/**
 * {@inheritdoc}
 */
final class JobBatchStatusResource extends AbstractStatusResource
{
    public const STATUS_INCOMPLETE = 'job_batch.status.incomplete';
    public const STATUS_READY = 'job_batch.status.ready';
    public const STATUS_DISPATCHED = 'job_batch.status.dispatched';

    /**
     * @return string[]
     */
    public static function getAllCanonicals(): array
    {
        return [
            self::STATUS_INCOMPLETE,
            self::STATUS_READY,
            self::STATUS_DISPATCHED,
        ];
    }
}
