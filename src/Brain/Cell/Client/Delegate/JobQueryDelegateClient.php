<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\ClientResource;
use Brain\Cell\EntityResource\Job\JobQueryNoteResource;
use Brain\Cell\EntityResource\Job\JobQueryResource;
use Brain\Cell\EntityResource\Job\JobResource;

class JobQueryDelegateClient extends DelegateClient
{
    /**
     * @param string $id
     *
     * @return JobQueryResource
     */
    public function getJobQuery(string $id)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/queries/%s', $id));

        return $this->request($context, new JobQueryResource());
    }

    /**
     * @param JobResource $jobResource
     * @param JobQueryResource $jobQueryResource
     *
     * @return JobQueryResource
     */
    public function postJobQuery(JobResource $jobResource, JobQueryResource $jobQueryResource)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost(sprintf(
            '/jobs/%s/queries',
            $jobResource->getId()
        ));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($jobQueryResource));

        return $this->request($context, $jobQueryResource);
    }

    /**
     * @param JobQueryResource $jobQueryResource
     * @param JobQueryNoteResource $jobQueryNoteResource
     *
     * @return JobQueryNoteResource
     */
    public function postJobQueryNote(JobQueryResource $jobQueryResource, JobQueryNoteResource $jobQueryNoteResource)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost(sprintf(
            '/queries/%s/notes',
            $jobQueryResource->getId()
        ));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($jobQueryNoteResource));

        return $this->request($context, $jobQueryNoteResource);
    }

    /**
     * @param JobQueryResource $jobQueryResource
     * @param ClientResource $clientResource
     *
     * @return JobQueryResource
     */
    public function putJobQueryAssignee(JobQueryResource $jobQueryResource, ClientResource $clientResource)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf(
            '/queries/%s/assignee',
            $jobQueryResource->getId()
        ));

        $jobQueryResource->setAssignee($clientResource);

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($jobQueryResource));

        return $this->request($context, $jobQueryResource);
    }

    /**
     * @param JobQueryResource $jobQueryResource
     *
     * @return JobQueryResource
     */
    public function removeJobQueryAssignee(JobQueryResource $jobQueryResource)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForDelete(sprintf(
            '/queries/%s/assignee',
            $jobQueryResource->getId()
        ));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($jobQueryResource));

        return $this->request($context, $jobQueryResource);
    }

    /**
     * @param JobQueryResource $jobQueryResource
     *
     * @return JobQueryResource
     */
    public function putJobQueryInProgress(JobQueryResource $jobQueryResource)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf(
            '/queries/%s/in-progress',
            $jobQueryResource->getId()
        ));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($jobQueryResource));

        return $this->request($context, $jobQueryResource);
    }

    /**
     * @param JobQueryResource $jobQueryResource
     *
     * @return JobQueryResource
     */
    public function putJobQueryResolved(JobQueryResource $jobQueryResource)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf(
            '/queries/%s/resolved',
            $jobQueryResource->getId()
        ));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($jobQueryResource));

        return $this->request($context, $jobQueryResource);
    }
}
