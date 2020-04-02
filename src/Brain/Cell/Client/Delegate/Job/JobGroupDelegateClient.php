<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Job;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\JobGroupJobResource;
use Brain\Cell\EntityResource\Job\JobGroupResource;
use Brain\Cell\EntityResource\Job\JobGroupResourceInterface;
use Brain\Cell\Logical\ArrayEncoderSerialisationOptions;
use Brain\Cell\Transfer\ResourceCollection;

class JobGroupDelegateClient extends DelegateClient
{
    public function getJobGroup(string $id): JobGroupResourceInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet(sprintf('/job/groups/%s', $id));

        /** @var JobGroupResourceInterface $resource */
        $resource = $this->request($context, new JobGroupResource());

        return $resource;
    }

    public function postJobGroup(JobGroupResourceInterface $group): JobGroupResourceInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost('/job/groups');

        $jobs = new ResourceCollection();
        $jobs->setEntityClass(JobGroupJobResource::class);
        foreach ($group->getJobs() as $job) {
            $jobGroupJob = new JobGroupJobResource();
            $jobGroupJob->setId($job->getId());
            $jobGroupJob->setIndex($job->getIndex());
            $jobs->add($jobGroupJob);
        }
        $group->setJobs($jobs);
        $payload = $this->resourceHandler->serialise($group, new ArrayEncoderSerialisationOptions([
            'serialiseResourceIdInsteadOfWholeBodyIfPossible' => false,
        ]));
        $context->setPayload($payload);

        /** @var JobGroupResourceInterface $resource */
        $resource = $this->request($context, $group);

        return $resource;
    }
}
