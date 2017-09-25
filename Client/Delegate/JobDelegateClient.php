<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\JobNoteResource;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\Enum\JobStatusEnum;
use Brain\Cell\Exception\ClientException;
use Brain\Cell\Transfer\ResourceCollection;

class JobDelegateClient extends DelegateClient
{

    /**
     * Filters available:
     * * id = string|string[]
     * * batch = string
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

        $collection = new ResourceCollection;
        $collection->setEntityClass(JobResource::class);

        return $this->request($context, $collection);
    }

    /**
     * Filters available:
     * * id = string|string[]
     *
     * @param array $filters
     * @param array $parameters
     *
     * @return ResourceCollection|JobResource[]
     */
    public function getJobIds(array $filters = [], $parameters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/job-ids');
        $context->getFilters()->add($filters);
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection;
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

        return $this->request($context, new JobResource);
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
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, $resource);
    }

    /**
     * @param string $jobId
     * @return JobResource
     */
    public function cloneJob($jobId)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf('/jobs/%s/clone', $jobId));

        return $this->request($context, new JobResource);
    }

    /**
     * @param JobResource $resource
     * @param string $status
     * @return JobResource
     */
    public function updateStatus(JobResource $resource, $status)
    {
        if (! in_array($status, JobStatusEnum::getAll())) {
            throw new ClientException(sprintf('Invalid status [%s]', $status));
        }

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf(
            '/jobs/%s/%s',
            $resource->getId(),
            str_replace('_', '-', $status)
        ));

        return $this->request($context, $resource);
    }

    /**
     * @param string $jobId
     * @param JobNoteResource $jobNoteResource
     * @return ResourceCollection|JobNoteResource[]
     */
    public function submitJobNote(
        string $jobId,
        JobNoteResource $jobNoteResource
    ) {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost(sprintf(
            '/jobs/%s/notes',
            $jobId
        ));

        //todo what happens if the client is configured not to have a resourceHandler?
        // - it has been assumed everywhere  sets a payload that a resource handler is
        //provided, So I am just running with the same assumption.

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($jobNoteResource));

        //todo I think that this is used so that you know that you are getting back a resource.
        $collection = new ResourceCollection();
        $collection->setEntityClass(JobNoteResource::class);

        return $this->request($context, $collection);
    }
}
