<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Common\AbstractStatusResource;

/**
 * {@inheritdoc}
 */
class JobBatchStatusResource extends AbstractStatusResource
{
    public const STATUS_INCOMPLETE = 'job_batch.status.incomplete';
    public const STATUS_READY = 'job_batch.status.ready';
}
