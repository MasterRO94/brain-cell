<?php

namespace Brain\Cell\EntityResource\Job;

/**
 * {@inheritdoc}
 */
class JobStatusResource extends StatusResource
{
    const STATUS_INCOMPLETE = 'job.status.incomplete';
    const STATUS_READY = 'job.status.ready';
    const STATUS_IMPOSITION_QUEUED = 'job.status.imposition_queued';
    const STATUS_IMPOSITION_MANUAL = 'job.status.imposition_manual';
    const STATUS_PRODUCTION_QUEUED = 'job.status.production_queued';
    const STATUS_PRODUCTION_STARTED = 'job.status.production_started';
    const STATUS_PRODUCTION_FINISHED = 'job.status.production_finished';
    const STATUS_PRODUCTION_DISPATCHED = 'job.status.production_dispatched';
    const STATUS_CANCELLED = 'job.status.cancelled';

    public static function getAllCanonicals()
    {
        return [
            static::STATUS_INCOMPLETE,
            static::STATUS_READY,
            static::STATUS_IMPOSITION_QUEUED,
            static::STATUS_IMPOSITION_MANUAL,
            static::STATUS_PRODUCTION_QUEUED,
            static::STATUS_PRODUCTION_STARTED,
            static::STATUS_PRODUCTION_FINISHED,
            static::STATUS_PRODUCTION_DISPATCHED,
            static::STATUS_CANCELLED,
        ];
    }
}
