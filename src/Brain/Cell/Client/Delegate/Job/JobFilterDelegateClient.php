<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Job;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\ClientResource;
use Brain\Cell\EntityResource\Job\JobFilterResource;
use Brain\Cell\EntityResource\Job\JobFilterResourceInterface;
use Brain\Cell\EntityResource\Job\JobResourceInterface;
use Brain\Cell\Transfer\ResourceCollection;

class JobFilterDelegateClient extends DelegateClient
{
    private const VERSION = '2.0';

    /**
     * @return JobFilterResourceInterface[]|ResourceCollection
     */
    public function getJobFilters(): ResourceCollection
    {
        $context = $this->configuration->createRequestContext(self::VERSION);
        $context->prepareContextForGet('/job/filters');

        $collection = new ResourceCollection();
        $collection->setEntityClass(JobFilterResource::class);

        /** @var JobFilterResourceInterface[]|ResourceCollection $collection */
        $collection = $this->request($context, $collection);

        return $collection;
    }

    public function postJobFilter(JobFilterResourceInterface $summary): JobFilterResourceInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION);
        $context->prepareContextForPost('/job/query-summaries');

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($summary));

        /** @var JobFilterResourceInterface $resource */
        $resource = $this->request($context, $summary);

        return $resource;
    }

    public function getJobFilter(string $id): JobFilterResourceInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION);
        $context->prepareContextForGet(sprintf('/queries/%s', $id));

        /** @var JobFilterResource $resource */
        $resource = $this->request($context, new JobFilterResource());

        return $resource;
    }

    /**
     * @return JobFilterResourceInterface[]|ResourceCollection
     */
    public function getJobFiltersForJob(string $jobId): ResourceCollection
    {
        $context = $this->configuration->createRequestContext(self::VERSION);
        $context->prepareContextForGet(sprintf('/jobs/%s/filters', $jobId));

        $collection = new ResourceCollection();
        $collection->setEntityClass(JobFilterResource::class);

        /** @var JobFilterResourceInterface[]|ResourceCollection $collection */
        $collection = $this->request($context, $collection);

        return $collection;
    }
}
