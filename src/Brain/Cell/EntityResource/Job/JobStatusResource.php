<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Common\AbstractStatusResource;
use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;

/**
 * {@inheritdoc}
 */
final class JobStatusResource extends AbstractStatusResource
{
    /**
     * @todo if these should be on AbstractStatusResource instead, move them there
     * @todo also create interfaces for all of these
     */
    use ResourceIdentityTrait;
    use CreatedAtTrait;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'createdAt' => DateResource::class,
        ];
    }


    public const STATUS_INCOMPLETE = 'job.status.incomplete';
    public const STATUS_READY = 'job.status.ready';
    public const STATUS_IMPOSITION_QUEUED = 'job.status.imposition_queued';
    public const STATUS_IMPOSITION_MANUAL = 'job.status.imposition_manual';
    public const STATUS_PRODUCTION_QUEUED = 'job.status.production_queued';
    public const STATUS_PRODUCTION_STARTED = 'job.status.production_started';
    public const STATUS_PRODUCTION_FINISHED = 'job.status.production_finished';
    public const STATUS_PRODUCTION_DISPATCHED = 'job.status.production_dispatched';
    public const STATUS_CANCELLED = 'job.status.cancelled';

    /**
     * @return string[]
     */
    public static function getAllCanonicals(): array
    {
        return [
            self::STATUS_INCOMPLETE,
            self::STATUS_READY,
            self::STATUS_IMPOSITION_QUEUED,
            self::STATUS_IMPOSITION_MANUAL,
            self::STATUS_PRODUCTION_QUEUED,
            self::STATUS_PRODUCTION_STARTED,
            self::STATUS_PRODUCTION_FINISHED,
            self::STATUS_PRODUCTION_DISPATCHED,
            self::STATUS_CANCELLED,
        ];
    }
}
