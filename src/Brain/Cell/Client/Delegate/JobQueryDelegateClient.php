<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\JobQueryNoteResource;
use Brain\Cell\EntityResource\Job\JobQueryResource;

class JobQueryDelegateClient extends DelegateClient
{
    /**
     * @param string $id
     *
     * @return JobQueryResource
     */
    public function getJobQuery($id)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/queries/%s', $id));

        return $this->request($context, new JobQueryResource());
    }

    /**
     * @param string $jobId
     * @param JobQueryResource $resource
     *
     * @return JobQueryResource
     */
    public function postJobQuery(string $jobId, JobQueryResource $resource)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost(sprintf(
            '/jobs/%s/queries',
            $jobId
        ));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, $resource);
    }

    /**
     * @param string $queryId
     * @param JobQueryNoteResource $resource
     *
     * @return JobQueryNoteResource
     */
    public function postJobQueryNote(string $queryId, JobQueryNoteResource $resource)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost(sprintf(
            '/queries/%s/notes',
            $queryId
        ));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, $resource);
    }

}
