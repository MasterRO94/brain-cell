<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\Transfer\ResourceCollection;

class JobDelegateClient extends DelegateClient
{

    /**
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

        return $this->request(
            $context,
            $collection
        );

    }

    /**
     * @param JobResource $resource
     *
     * @return array|\Brain\Cell\Transfer\AbstractResource
     */
    public function postJob(JobResource $resource)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/jobs');

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($resource));

        return $this->request(
            $context,
            $resource
        );

    }

}
