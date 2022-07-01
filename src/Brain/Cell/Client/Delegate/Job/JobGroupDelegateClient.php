<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Job;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\JobGroupResource;
use Brain\Cell\EntityResource\Job\JobGroupResourceInterface;
use Brain\Cell\Logical\ArrayEncoderSerialisationOptions;

class JobGroupDelegateClient extends DelegateClient
{
    private const GET_PATH = '/job/groups/%s';

    public function getJobGroup(string $id): JobGroupResourceInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet(sprintf(self::GET_PATH, $id));

        /** @var JobGroupResourceInterface $resource */
        $resource = $this->request($context, new JobGroupResource());

        return $resource;
    }

    public function postJobGroup(JobGroupResourceInterface $group): JobGroupResourceInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost('/job/groups');

        $payload = $this->resourceHandler->serialise($group, new ArrayEncoderSerialisationOptions([
            'serialiseResourceIdInsteadOfWholeBodyIfPossible' => false,
        ]));
        $context->setPayload($payload);

        /** @var JobGroupResourceInterface $resource */
        $resource = $this->request($context, $group);

        return $resource;
    }

    /**
     * Async return a job group by id.
     *
     * @param string[] $ids
     *
     * @return JobGroupResourceInterface[]
     */
    public function getAsync(array $ids): array
    {
        $contexts = [];

        foreach ($ids as $key => $id) {
            $context = $this->configuration->createRequestContext(self::VERSION_V1);
            $context->prepareContextForGet(sprintf(self::GET_PATH, $id));

            $contexts[$key] = $context;
        }

        return $this->requestAsync($contexts, JobGroupResource::class);
    }
}
