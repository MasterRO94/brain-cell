<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Common\AbstractStatusResource;

/**
 * {@inheritdoc}
 */
class JobBatchStatusResource extends AbstractStatusResource
{
    const STATUS_INCOMPLETE = 'job_batch.status.incomplete';
    const STATUS_READY = 'job_batch.status.ready';
}
