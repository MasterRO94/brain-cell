<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Artwork\ArtworkResource;
use Brain\Cell\EntityResource\Job\CreateJobFromProductResource;
use Brain\Cell\EntityResource\Job\JobMetaResource;
use Brain\Cell\EntityResource\Job\JobNoteResource;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\EntityResource\Job\JobStatusResource;
use Brain\Cell\Exception\ClientException;
use Brain\Cell\Transfer\ResourceCollection;

class JobDelegateClient extends DelegateClient
{
    /**
     * Filters available:
     * * id = string|string[]
     * * batch = string.
     *
     * @param array $filters
     * @param array $parameters
     *
     * @return ResourceCollection|JobResource[]
     */
    public function getJobs(array $filters = [], $parameters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/jobs');
        $context->getFilters()->add($filters);
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(JobResource::class);

        return $this->request($context, $collection);
    }

    /**
     * Filters available:
     * * id = string|string[].
     *
     * @param array $filters
     * @param array $parameters
     *
     * @return ResourceCollection|JobResource[]
     */
    public function getJobIds(array $filters = [], $parameters = [])
    {
        throw new \RuntimeException("Do not use getJobIds - use getJobs instead");
    }

    /**
     * @param string $id
     *
     * @return JobResource
     */
    public function getJob($id)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/jobs/%s', $id));

        return $this->request($context, new JobResource());
    }

    /**
     * @param JobResource $resource
     *
     * @return JobResource
     */
    public function postJob(JobResource $resource)
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

    /**
     * @param CreateJobFromProductResource $resource
     *
     * @return JobResource
     */
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

    /**
     * @param string $jobId
     *
     * @return JobResource
     */
    public function cloneJob($jobId)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf('/jobs/%s/clone', $jobId));

        return $this->request($context, new JobResource());
    }

    /**
     * @param JobResource $resource
     * @param string $status
     *
     * @return JobResource
     */
    public function updateStatus(JobResource $resource, $status)
    {
        if (!in_array($status, JobStatusResource::getAllCanonicals())) {
            throw new ClientException(sprintf('Invalid status [%s]', $status));
        }

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf(
            '/jobs/%s/%s',
            $resource->getId(),
            str_replace('job.status.', '', str_replace('_', '-', $status))
        ));

        return $this->request($context, $resource);
    }

    /**
     * @param JobResource $resource
     * @param ArtworkResource $artwork
     *
     * @return JobResource
     */
    public function updateArtwork(JobResource $resource, ArtworkResource $artwork)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf(
            '/jobs/%s/artwork',
            $resource->getId()
        ));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($artwork));

        return $this->request($context, $artwork);
    }

    /**
     * @param string $jobId
     * @param JobNoteResource $jobNoteResource
     *
     * @return JobResource
     */
    public function submitJobNote(
        string $jobId,
        JobNoteResource $jobNoteResource
    ) {
        return $this->submitNote(
            $jobId,
            $jobNoteResource,
            'notes'
        );
    }

    /**
     * @param string $jobId
     * @param JobNoteResource $jobNoteResource
     *
     * @return JobResource
     */
    public function submitQueryJobNote(
        string $jobId,
        JobNoteResource $jobNoteResource
    ) {
        return $this->submitNote(
            $jobId,
            $jobNoteResource,
            'query'
        );
    }

    /**
     * @param string $jobId
     * @param JobNoteResource $jobNoteResource
     *
     * @return JobResource
     */
    public function submitQueryResolvedJobNote(
        string $jobId,
        JobNoteResource $jobNoteResource
    ) {
        return $this->submitNote(
            $jobId,
            $jobNoteResource,
            'query-resolution'
        );
    }

    /**
     * @param string $jobId
     * @param JobNoteResource $jobNoteResource
     * @param string $endpoint
     *
     * @return JobResource
     */
    protected function submitNote(
        string $jobId,
        JobNoteResource $jobNoteResource,
        string $endpoint
    ) {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost(sprintf(
            '/jobs/%s/%s',
            $jobId,
            $endpoint
        ));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($jobNoteResource));

        return $this->request($context, new JobResource());
    }

    public function submitJobMeta(string $jobId, JobMetaResource $meta)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf(
            '/jobs/%s/meta',
            $jobId
        ));

        $newResource = new JobResource();
        $newResource->setMeta($meta);

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($newResource));

        return $this->request($context, $newResource);
    }
}
