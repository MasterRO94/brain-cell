<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Job;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\ClientResource;
use Brain\Cell\EntityResource\Job\JobQueryNoteResource;
use Brain\Cell\EntityResource\Job\JobQueryResource;
use Brain\Cell\EntityResource\Job\JobResource;

class JobQueryDelegateClient extends DelegateClient
{
    public function getJobQuery(string $id): JobQueryResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/queries/%s', $id));

        return $this->request($context, new JobQueryResource());
    }

    public function postJobQuery(JobResource $jobResource, JobQueryResource $jobQueryResource): JobQueryResource
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

    public function postJobQueryNote(JobQueryResource $jobQueryResource, JobQueryNoteResource $jobQueryNoteResource): JobQueryNoteResource
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

    public function putJobQueryAssignee(JobQueryResource $jobQueryResource, ClientResource $clientResource): JobQueryResource
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

    public function removeJobQueryAssignee(JobQueryResource $jobQueryResource): JobQueryResource
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

    public function putJobQueryInProgress(JobQueryResource $jobQueryResource): JobQueryResource
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

    public function putJobQueryResolved(JobQueryResource $jobQueryResource): JobQueryResource
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
