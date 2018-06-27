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
     * @return JobResource[]|ResourceCollection
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
     * @param JobResource $jobResource
     * @param JobStatusResource $statusResource
     *
     * @return JobResource
     */
    public function updateStatus(JobResource $jobResource, JobStatusResource $statusResource)
    {
        if (!in_array(
            $statusResource->getCanonical(),
            JobStatusResource::getAllCanonicals()
        )) {
            throw new ClientException(sprintf(
                'Invalid status canonical [%s]',
                $statusResource->getCanonical()
            ));
        }

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf(
            '/jobs/%s/status',
            $jobResource->getId()
        ));

        $jobStatusResource = new JobResource();
        $jobStatusResource->setStatus($statusResource);

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($jobStatusResource));

        return $this->request($context, $jobResource);
    }

    /**
     * @param JobResource $jobResource
     * @param JobStatusResource $statusResource
     *
     * @return JobResource
     */
    public function updatePhase(JobResource $jobResource, JobStatusResource $statusResource)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf(
            '/jobs/%s/phase',
            $jobResource->getId()
        ));

        $jobPhaseResource = new JobResource();
        $jobPhaseResource->setStatus($statusResource);

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($jobPhaseResource));

        return $this->request($context, $jobResource);
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
     * @param JobResource $job
     * @param JobNoteResource $jobNoteResource
     *
     * @return JobResource
     */
    public function submitJobNote(JobResource $job, JobNoteResource $jobNoteResource)
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

    /**
     * @param JobResource $job
     * @param JobMetaResource $meta
     *
     * @return JobResource
     */
    public function submitJobMeta(JobResource $job, JobMetaResource $meta)
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
