<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\Exception\ClientException;
use Brain\Cell\Transfer\ResourceCollection;

class JobDelegateClient extends DelegateClient
{

    /**
     * Filters available:
     * * id = string|string[]
     *
     * @param array $filters
     *
     * @return ResourceCollection|JobResource[]
     */
    public function getJobs(array $filters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/jobs');
        $context->getFilters()->add($filters);

        $collection = new ResourceCollection;
        $collection->setEntityClass(JobResource::class);

        return $this->request($context, $collection);
    }

    /**
     * Filters available:
     * * id = string|string[]
     *
     * @param array $filters
     *
     * @return ResourceCollection|JobResource[]
     */
    public function getJobIds(array $filters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/job-ids');
        $context->getFilters()->add($filters);

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
     * @param JobResource $resource
     * @param string $status
     * @return JobResource
     */
    public function updateStatus(JobResource $resource, $status)
    {
        static $validStatuses = [
            'production-queue',
            'production-started',
            'production-finished',
            'production-dispatched',
        ];

        if (! in_array($status, $validStatuses)) {
            throw new ClientException(sprintf('Invalid status [%s]', $status));
        }

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf(
            '/jobs/%s/%s',
            $resource->getId(),
            $status
        ));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, $resource);
    }
}
