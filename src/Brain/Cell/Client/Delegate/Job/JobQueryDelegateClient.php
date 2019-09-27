<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Job;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\ClientResource;
use Brain\Cell\EntityResource\Job\JobQueryNoteResource;
use Brain\Cell\EntityResource\Job\JobQueryResource;
use Brain\Cell\EntityResource\Job\JobQuerySummaryResource;
use Brain\Cell\EntityResource\Job\JobQuerySummaryResourceInterface;
use Brain\Cell\EntityResource\Job\JobResourceInterface;
use Brain\Cell\Transfer\ResourceCollection;

class JobQueryDelegateClient extends DelegateClient
{
    /**
     * @return JobQuerySummaryResourceInterface[]|ResourceCollection
     */
    public function getJobQuerySummaries(): ResourceCollection
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/job/query-summaries');

        $collection = new ResourceCollection();
        $collection->setEntityClass(JobQuerySummaryResource::class);

        /** @var JobQuerySummaryResourceInterface[]|ResourceCollection $collection */
        $collection = $this->request($context, $collection);

        return $collection;
    }

    public function postJobQuerySummary(JobQuerySummaryResourceInterface $summary): JobQuerySummaryResourceInterface
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/job/query-summaries');

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($summary));

        /** @var JobQuerySummaryResourceInterface $resource */
        $resource = $this->request($context, $summary);

        return $resource;
    }

    public function getJobQuery(string $id): JobQueryResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/queries/%s', $id));

        /** @var JobQueryResource $resource */
        $resource = $this->request($context, new JobQueryResource());

        return $resource;
    }

    public function postJobQuery(JobResourceInterface $job, JobQueryResource $query): JobQueryResource
    {
        $id = $job->getId();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost(sprintf('/jobs/%s/queries', $id));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($query));

        /** @var JobQueryResource $resource */
        $resource = $this->request($context, $query);

        return $resource;
    }

    public function postJobQueryNote(JobQueryResource $query, JobQueryNoteResource $note): JobQueryNoteResource
    {
        $id = $query->getId();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost(sprintf('/queries/%s/notes', $id));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($note));

        /** @var JobQueryNoteResource $resource */
        $resource = $this->request($context, $note);

        return $resource;
    }

    public function putJobQueryAssignee(JobQueryResource $query, ClientResource $clientResource): JobQueryResource
    {
        $id = $query->getId();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf('/queries/%s/assignee', $id));

        $query->setAssignee($clientResource);

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($query));

        /** @var JobQueryResource $resource */
        $resource = $this->request($context, $query);

        return $resource;
    }

    public function removeJobQueryAssignee(JobQueryResource $query): JobQueryResource
    {
        $id = $query->getId();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForDelete(sprintf('/queries/%s/assignee', $id));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($query));

        /** @var JobQueryResource $resource */
        $resource = $this->request($context, $query);

        return $resource;
    }

    public function putJobQueryInProgress(JobQueryResource $query): JobQueryResource
    {
        $id = $query->getId();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf('/queries/%s/in-progress', $id));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($query));

        /** @var JobQueryResource $resource */
        $resource = $this->request($context, $query);

        return $resource;
    }

    public function putJobQueryResolved(JobQueryResource $query): JobQueryResource
    {
        $id = $query->getId();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf('/queries/%s/resolved', $id));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($query));

        /** @var JobQueryResource $response */
        $response = $this->request($context, new JobQueryResource());

        return $response;
    }
}
