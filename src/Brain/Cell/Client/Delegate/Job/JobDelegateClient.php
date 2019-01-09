<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Job;

use Brain\Cell\Client\Delegate\Job\Note\JobNoteDelegateClient;
use Brain\Cell\Client\Delegate\Job\Status\JobStatusDelegateClient;
use Brain\Cell\Client\DelegateClient;
use Brain\Cell\Client\Request\RequestFilter;
use Brain\Cell\Client\Request\RequestFilterInterface;
use Brain\Cell\EntityResource\Common\AbstractStatusResource;
use Brain\Cell\EntityResource\Common\Status\StatusTransitionResource;
use Brain\Cell\EntityResource\Job\ClientWorkflow\PhaseResource;
use Brain\Cell\EntityResource\Job\CreateJobFromProductResource;
use Brain\Cell\EntityResource\Job\JobMetaResourceInterface;
use Brain\Cell\EntityResource\Job\JobNoteResource;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\EntityResource\Job\JobResourceInterface;
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
     * Operate on job notes.
     */
    public function notes(): JobNoteDelegateClient
    {
        return new JobNoteDelegateClient($this->configuration);
    }

    /**
     * Create a job.
     */
    public function create(JobResourceInterface $job): JobResourceInterface
    {
        $handler = $this->configuration->getResourceHandler();
        $payload = $handler->serialise($job);

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/jobs');
        $context->setPayload($payload);

        /** @var JobResource $response */
        $response = $this->request($context, $job);

        return $response;
    }

    /**
     * Return a job by id.
     */
    public function get(string $id): JobResourceInterface
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/jobs/%s', $id));

        /** @var JobResource $resource */
        $resource = $this->request($context, new JobResource());

        return $resource;
    }

    /**
     * List all jobs.
     *
     * @return JobResource[]|ResourceCollection
     */
    public function all(RequestFilterInterface $filter): ResourceCollection
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/jobs');
        $context->getFilters()->add($filter->getFilters());
        $context->getParameters()->add($filter->getParameters());

        $collection = new ResourceCollection();
        $collection->setEntityClass(JobResource::class);

        /** @var ResourceCollection $resource */
        $resource = $this->request($context, $collection);

        return $resource;
    }

    /**
     * Mark the job as cancelled.
     */
    public function cancel(JobResourceInterface $job, string $reason): AbstractStatusResource
    {
        $transition = new StatusTransitionResource();
        $transition->setCanonical(JobStatusResource::STATUS_CANCELLED);
        $transition->setReason($reason);

        $resource = $this->status()->transition($job, $transition);

        return $resource;
    }

    /**
     * @deprecated use jobs()->all() instead.
     *
     * @param mixed[] $filters
     * @param mixed[] $parameters
     *
     * @return JobResource[]|ResourceCollection
     */
    public function getJobs(array $filters = [], array $parameters = []): ResourceCollection
    {
        $filter = new RequestFilter();
        $filter->filters()->add($filters);
        $filter->parameters()->add($parameters);

        /** @var ResourceCollection $resource */
        $resource = $this->all($filter);

        return $resource;
    }

    /**
     * @deprecated use jobs()->get() instead.
     */
    public function getJob(string $id): JobResource
    {
        /** @var JobResource $resource */
        $resource = $this->get($id);

        return $resource;
    }

    /**
     * @deprecated use jobs()->created() instead.
     */
    public function postJob(JobResource $job): JobResource
    {
        /** @var JobResource $response */
        $response = $this->create($job);

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

    public function cloneJob(string $jobId): JobResourceInterface
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf('/jobs/%s/clone', $jobId));

        /** @var JobResourceInterface $resource */
        $resource = $this->request($context, new JobResource());

        return $resource;
    }

    /**
     * @deprecated use jobs()->status()->transition() instead.
     */
    public function updateStatus(JobResourceInterface $job, JobStatusResource $status): JobResourceInterface
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
            $job->getId()
        ));

        $jobStatusResource = new JobResource();
        $jobStatusResource->setStatus($status);

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($jobStatusResource));

        /** @var JobResourceInterface $job */
        $job = $this->request($context, $job);

        return $job;
    }

    public function updatePhase(JobResourceInterface $job, PhaseResource $phaseResource): JobResourceInterface
    {
        $id = $job->getId();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf('/jobs/%s/phase', $id));

        $jobPhaseResource = new JobResource();
        $jobPhaseResource->setPhase($phaseResource);

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($jobPhaseResource));

        /** @var JobResourceInterface $resource */
        $resource = $this->request($context, $job);

        return $resource;
    }

    /**
     * @deprecated Use jobs()->notes()->create() instead.
     */
    public function submitJobNote(JobResourceInterface $job, JobNoteResource $note): JobResourceInterface
    {
        /** @var JobResource $resource */
        $resource = $this->notes()->create($job, $note);

        return $resource;
    }

    /**
     * @deprecated Use replaceJobMeta() instead.
     */
    public function submitJobMeta(JobResourceInterface $job, JobMetaResourceInterface $meta): JobResourceInterface
    {
        return $this->replaceJobMeta($job, $meta);
    }

    /**
     * Replace the meta against a job.
     *
     * If you wish to perform an update I recommend you merge the job meta instead.
     */
    public function replaceJobMeta(JobResourceInterface $job, JobMetaResourceInterface $meta): JobResourceInterface
    {
        $id = $id = $job->getId();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf('/jobs/%s/meta', $id));

        $newResource = new JobResource();
        $newResource->setMeta($meta);

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($newResource));

        /** @var JobResourceInterface $resource */
        $resource = $this->request($context, $newResource);

        return $resource;
    }
}
