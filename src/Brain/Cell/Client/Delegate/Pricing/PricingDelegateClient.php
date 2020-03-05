<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Pricing;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\JobResourceInterface;
use Brain\Cell\EntityResource\Pricing\PriceResource;
use Brain\Cell\EntityResource\Pricing\PriceResourceInterface;

/**
 * API client for operating on pricing.
 */
class PricingDelegateClient extends DelegateClient
{
    /**
     * Return pricing information for the given job.
     */
    public function price(JobResourceInterface $job): PriceResourceInterface
    {
        $payload = $this->resourceHandler->serialise($job);

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost('/pricing');
        $context->setPayload($payload);

        /** @var PriceResourceInterface $resource */
        $resource = $this->request($context, new PriceResource());

        return $resource;
    }

    /**
     * @deprecated Use price() instead.
     */
    public function getPricing(JobResourceInterface $job): PriceResourceInterface
    {
        return $this->price($job);
    }
}
