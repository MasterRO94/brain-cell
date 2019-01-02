<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\JobResource;

class PricingDelegateClient extends DelegateClient
{
    public function getPricing(JobResource $jobResource): JobResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/pricing');

        $handler = $this->configuration->getResourceHandler();
        $payload = $handler->serialise($jobResource);
        $context->setPayload($payload);

        return $this->request($context, new JobResource());
    }
}
