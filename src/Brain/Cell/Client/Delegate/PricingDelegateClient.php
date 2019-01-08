<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\EntityResource\Job\JobResourceInterface;

class PricingDelegateClient extends DelegateClient
{
    public function getPricing(JobResourceInterface $job): JobResourceInterface
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/pricing');

        $handler = $this->configuration->getResourceHandler();
        $payload = $handler->serialise($job);
        $context->setPayload($payload);

        /** @var JobResourceInterface $resource */
        $resource = $this->request($context, new JobResource());

        return $resource;
    }
}
