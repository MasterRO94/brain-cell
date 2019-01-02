<?php

declare(strict_types=1);

namespace Brain\Cell\Enum;

use Brain\Cell\EntityResource\Job\JobBatchStatusResource;

/**
 * @deprecated use JobBatchStatusResource constants instead.
 */
final class JobBatchStatusEnum extends JobBatchStatusResource
{
    /**
     * Return all statuses.
     *
     * @return string[]
     */
    public static function getAll(): array
    {
        return [
            JobBatchStatusResource::STATUS_INCOMPLETE,
            JobBatchStatusResource::STATUS_READY,
        ];
    }
}
