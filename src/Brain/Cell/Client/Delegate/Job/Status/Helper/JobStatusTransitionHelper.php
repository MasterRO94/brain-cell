<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Job\Status\Helper;

use Brain\Cell\Client\Delegate\Job\Status\JobStatusDelegateClient;
use Brain\Cell\EntityResource\Common\AbstractStatusResource;
use Brain\Cell\EntityResource\Common\Status\StatusTransitionResource;
use Brain\Cell\EntityResource\Job\JobResourceInterface;
use Brain\Cell\EntityResource\Job\JobStatusResource;

/**
 * API client helper for performing job status transition.
 */
final class JobStatusTransitionHelper
{
    private $delegate;

    public function __construct(JobStatusDelegateClient $delegate)
    {
        $this->delegate = $delegate;
    }

    /**
     * Mark the job as production dispatched.
     */
    public function dispatched(JobResourceInterface $job, ?string $reason): AbstractStatusResource
    {
        $status = JobStatusResource::STATUS_PRODUCTION_DISPATCHED;

        return $this->handle($job, $status, $reason);
    }

    /**
     * Handle the transition.
     */
    private function handle(JobResourceInterface $job, string $status, ?string $reason): AbstractStatusResource
    {
        $transition = new StatusTransitionResource();
        $transition->setCanonical($status);
        $transition->setReason($reason);

        $resource = $this->delegate->transition($job, $transition);

        return $resource;
    }
}
