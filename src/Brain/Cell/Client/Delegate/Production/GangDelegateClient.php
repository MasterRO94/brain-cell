<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Production;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\EntityResource\Production\GangResource;
use Brain\Cell\EntityResource\Production\GangResourceInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\Transfer\ResourceCollection;

class GangDelegateClient extends DelegateClient
{
    /**
     * Create a new gang.
     * The alias is used to identify gangs on the client application.
     */
    public function create(string $alias): GangResourceInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V2);
        $context->prepareContextForPost('/gangs');
        $context->setPayload(['alias' => $alias]);

        /** @var GangResourceInterface $resource */
        $resource = $this->request($context, new GangResource());

        return $resource;
    }

    /**
     * Get the gang by the Gang id.
     */
    public function get(string $id): GangResourceInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V2);
        $context->prepareContextForGet(sprintf('/gangs/%s', $id));

        /** @var GangResourceInterface $resource */
        $resource = $this->request($context, new GangResource());

        return $resource;
    }

    /**
     * Add jobs to the gang.
     *
     * @param JobResource[]|ResourceIdentityInterface[]|ResourceCollection $jobs
     */
    public function addJobs(string $id, ResourceCollection $jobs): void
    {
        if ($jobs->isEmpty()) {
            return;
        }

        $context = $this->configuration->createRequestContext(self::VERSION_V2);
        $context->prepareContextForLink(sprintf('/gangs/%s/jobs', $id));

        $seriliasedJobs = $this->resourceHandler->serialise($jobs);
        $context->setPayload(['jobs' => $seriliasedJobs]);

        $this->configuration->getRequestAdapter()->request($context);
    }

    /**
     * Remove jobs from the gang
     */
    public function removeJobs(string $id, ResourceCollection $jobs): void
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V2);
        $context->prepareContextForUnlink(sprintf('/gangs/%s/jobs', $id));

        $this->configuration->getRequestAdapter()->request($context);
    }
}
