<?php

declare(strict_types=1);

namespace Brain\Cell\Enum;

use Brain\Cell\EntityResource\Job\JobStatusResource;

/**
 * @deprecated use JobStatusResource constants instead.
 */
final class JobStatusEnum extends JobStatusResource
{
    /**
     * Return all statuses.
     *
     * @return string[]
     */
    public static function getAll(): array
    {
        return [
            JobStatusResource::STATUS_INCOMPLETE,
            JobStatusResource::STATUS_READY,
            JobStatusResource::STATUS_PRODUCTION_QUEUED,
            JobStatusResource::STATUS_PRODUCTION_STARTED,
            JobStatusResource::STATUS_IMPOSITION_QUEUED,
            JobStatusResource::STATUS_IMPOSITION_MANUAL,
            JobStatusResource::STATUS_PRODUCTION_FINISHED,
            JobStatusResource::STATUS_PRODUCTION_DISPATCHED,
            JobStatusResource::STATUS_CANCELLED,
        ];
    }
}
