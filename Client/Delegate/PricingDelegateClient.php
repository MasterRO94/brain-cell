<?php
/**
 * @maintainer Alex Moon <alex.moon@printed.com>
 */

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\JobResource;

class PricingDelegateClient extends DelegateClient
{

    /**
     * @param JobResource $jobResource
     * @return JobResource
     */
    public function getPricing(JobResource $jobResource)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/pricing');

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($jobResource));

        return $this->request($context, new JobResource);

    }
}
