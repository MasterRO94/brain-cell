<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Job;

use Brain\Cell\Client\Delegate\Job\Status\JobStatusDelegateClient;
use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\ClientWorkflow\PhaseResource;
use Brain\Cell\EntityResource\Job\CreateJobFromProductResource;
use Brain\Cell\EntityResource\Job\JobMetaResource;
use Brain\Cell\EntityResource\Job\JobNoteResource;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\EntityResource\Job\JobStatusResource;
use Brain\Cell\Exception\ClientException;
use Brain\Cell\Transfer\ResourceCollection;

/**
 * API client for operating on jobs.
 */
class JobDelegateClient extends DelegateClient
{
    /**
     * Operate on job statuses.
     */
    public function status(): JobStatusDelegateClient
    {
        return new JobStatusDelegateClient($this->configuration);
    }

    /**
     * @param mixed[] $filters
     * @param mixed[] $parameters
     *
     * @return JobResource[]|ResourceCollection
     */
    public function getJobs(array $filters = [], array $parameters = []): ResourceCollection
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/jobs');
        $context->getFilters()->add($filters);
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(JobResource::class);

        /** @var ResourceCollection $resource */
        $resource = $this->request($context, $collection);

        return $resource;
    }

    public function getJob(string $id): JobResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/jobs/%s', $id));

        /** @var JobResource $resource */
        $resource = $this->request($context, new JobResource());

        return $resource;
    }

    public function postJob(JobResource $resource): JobResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/jobs');

        $handler = $this->configuration->getResourceHandler();
        $payload = $handler->serialise($resource);

        $context->setPayload($payload);

        /** @var JobResource $response */
        $response = $this->request($context, $resource);

        return $response;
    }

    public function createJobFromProduct(CreateJobFromProductResource $resource): JobResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/jobs');

        $handler = $this->configuration->getResourceHandler();
        $payload = $handler->serialise($resource);

        $context->setPayload($payload);

        /** @var JobResource $response */
        $response = $this->request($context, new JobResource());

        return $response;
    }

    public function cloneJob(string $jobId): JobResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf('/jobs/%s/clone', $jobId));

        /** @var JobResource $resource */
        $resource = $this->request($context, new JobResource());

        return $resource;
    }

    public function updateStatus(JobResource $resource, JobStatusResource $status): JobResource
    {
        if (!in_array($status->getCanonical(), JobStatusResource::getAllCanonicals())) {
            throw new ClientException(sprintf(
                'Invalid status canonical [%s]',
                $status->getCanonical()
            ));
        }

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf(
            '/jobs/%s/status',
            $resource->getId()
        ));

        $jobStatusResource = new JobResource();
        $jobStatusResource->setStatus($status);

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($jobStatusResource));

        /** @var JobResource $resource */
        $resource = $this->request($context, $resource);

        return $resource;
    }

    public function updatePhase(JobResource $jobResource, PhaseResource $phaseResource): JobResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf(
            '/jobs/%s/phase',
            $jobResource->getId()
        ));

        $jobPhaseResource = new JobResource();
        $jobPhaseResource->setPhase($phaseResource);

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($jobPhaseResource));

        return $this->request($context, $jobResource);
    }

    public function submitJobNote(JobResource $job, JobNoteResource $jobNoteResource): JobResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost(sprintf(
            '/jobs/%s/notes',
            $job->getId()
        ));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($jobNoteResource));

        return $this->request($context, new JobResource());
    }

    public function submitJobMeta(JobResource $job, JobMetaResource $meta): JobResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf(
            '/jobs/%s/meta',
            $job->getId()
        ));

        $newResource = new JobResource();
        $newResource->setMeta($meta);

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($newResource));

        return $this->request($context, $newResource);
    }
}
