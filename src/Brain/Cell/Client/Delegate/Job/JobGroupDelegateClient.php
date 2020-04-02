<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Job;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\JobGroupResource;
use Brain\Cell\EntityResource\Job\JobGroupResourceInterface;
use Brain\Cell\Logical\ArrayEncoderSerialisationOptions;

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

        $payload = $this->resourceHandler->serialise($group, new ArrayEncoderSerialisationOptions([
            'serialiseResourceIdInsteadOfWholeBodyIfPossible' => false,
        ]));
        $context->setPayload($payload);

        /** @var JobGroupResourceInterface $resource */
        $resource = $this->request($context, $group);

        return $resource;
    }
}
