<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Job\Status;

use Brain\Cell\Client\Delegate\Job\Status\Helper\JobStatusTransitionHelper;
use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Common\AbstractStatusResource;
use Brain\Cell\EntityResource\Common\Status\StatusTransitionResource;
use Brain\Cell\EntityResource\Common\Status\StatusTransitionResourceInterface;
use Brain\Cell\EntityResource\Job\JobResourceInterface;
use Brain\Cell\EntityResource\Job\JobStatusResource;
use Brain\Cell\Transfer\ResourceCollection;

/**
 * API client for operating on job statuses.
 */
/* final */class JobStatusDelegateClient extends DelegateClient
{
    /**
     * Return the transition helper.
     */
    public function helper(): JobStatusTransitionHelper
    {
        return new JobStatusTransitionHelper($this);
    }

    /**
     * List all available transitions for the job.
     *
     * @return ResourceCollection|StatusTransitionResourceInterface[]
     */
    public function available(JobResourceInterface $job): ResourceCollection
    {
        $id = $job->getId();

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPut(sprintf('/jobs/%s/status/transitions', $id));

        $collection = new ResourceCollection();
        $collection->setEntityClass(StatusTransitionResource::class);

        /** @var ResourceCollection $resource */
        $resource = $this->request($context, $collection);

        return $resource;
    }

    /**
     * Transition a job to the given status.
     */
    public function transition(
        JobResourceInterface $job,
        StatusTransitionResourceInterface $status
    ): AbstractStatusResource {
        $id = $job->getId();

        $payload = $this->resourceHandler->serialise($status);

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPut(sprintf('/jobs/%s/status', $id));
        $context->setPayload($payload);

        /** @var JobStatusResource $resource */
        $resource = $this->request($context, new JobStatusResource());

        return $resource;
    }

    /**
     * Async transition a job to the given status.
     *
     * @param JobResourceInterface[] $jobs
     *
     * @return AbstractStatusResource[]
     */
    public function transitionAsync(array $jobs, StatusTransitionResourceInterface $status): array
    {
        $contexts = [];

        $payload = $this->resourceHandler->serialise($status);

        foreach ($jobs as $key => $job) {
            $id = $job->getId();

            $context = $this->configuration->createRequestContext(self::VERSION_V1);
            $context->prepareContextForPut(sprintf('/jobs/%s/status', $id));
            $context->setPayload($payload);

            $contexts[$key] = $context;
        }

        return $this->requestAsync($contexts, JobStatusResource::class);
    }
}
