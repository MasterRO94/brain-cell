<?php

namespace Brain\Cell\Enum;

/**
 * Copy-paste of Brain/Component/Job/Enum/JobStatusEnum.php in Brain
 * Please keep these synchronised.
 *
 * @deprecated use JobStatusResource constants instead.
 */
class JobStatusEnum
{
    const STATUS_INCOMPLETE = 'incomplete';
    const STATUS_READY = 'ready';
    const STATUS_IMPOSITION_QUEUED = 'imposition_queued';
    const STATUS_IMPOSITION_MANUAL = 'imposition_manual';
    const STATUS_PRODUCTION_QUEUED = 'production_queued';
    const STATUS_PRODUCTION_STARTED = 'production_started';
    const STATUS_PRODUCTION_FINISHED = 'production_finished';
    const STATUS_PRODUCTION_DISPATCHED = 'production_dispatched';
    const STATUS_CANCELLED = 'cancelled';

    public static function getAll(): array
    {
        return [
            static::STATUS_INCOMPLETE,
            static::STATUS_READY,
            static::STATUS_PRODUCTION_QUEUED,
            static::STATUS_PRODUCTION_STARTED,
            static::STATUS_IMPOSITION_QUEUED,
            static::STATUS_IMPOSITION_MANUAL,
            static::STATUS_PRODUCTION_FINISHED,
            static::STATUS_PRODUCTION_DISPATCHED,
            static::STATUS_CANCELLED,
        ];
    }
}
