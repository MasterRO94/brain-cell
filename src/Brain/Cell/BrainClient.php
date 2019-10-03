<?php

declare(strict_types=1);

namespace Brain\Cell;

use Brain\Cell\Client\Delegate\ArtifactDelegateClient;
use Brain\Cell\Client\Delegate\ArtworkDelegateClient;
use Brain\Cell\Client\Delegate\AuthenticationDelegateClient;
use Brain\Cell\Client\Delegate\ClientWorkflowDelegateClient;
use Brain\Cell\Client\Delegate\DeliveryDelegateClient;
use Brain\Cell\Client\Delegate\File\FileDelegateClient;
use Brain\Cell\Client\Delegate\Job\JobBatchDelegateClient;
use Brain\Cell\Client\Delegate\Job\JobComponentDelegateClient;
use Brain\Cell\Client\Delegate\Job\JobDelegateClient;
use Brain\Cell\Client\Delegate\Job\JobFilterDelegateClient;
use Brain\Cell\Client\Delegate\Job\JobQueryDelegateClient;
use Brain\Cell\Client\Delegate\Pricing\PricingDelegateClient;
use Brain\Cell\Client\Delegate\ProductDelegateClient;
use Brain\Cell\Client\Delegate\Production\ProductionDelegateClient;
use Brain\Cell\Client\Delegate\StockDelegateClient;
use Brain\Cell\Client\Delegate\WebhookDelegateClient;
use Brain\Cell\Client\DelegateClient;

/**
 * {@inheritdoc}
 */
class BrainClient extends DelegateClient implements BrainClientInterface
{
    public function authentication(): AuthenticationDelegateClient
    {
        return new AuthenticationDelegateClient($this->configuration);
    }

    public function webhooks(): WebhookDelegateClient
    {
        return new WebhookDelegateClient($this->configuration);
    }

    public function jobs(): JobDelegateClient
    {
        return new JobDelegateClient($this->configuration);
    }

    public function files(): FileDelegateClient
    {
        return new FileDelegateClient($this->configuration);
    }

    public function productions(): ProductionDelegateClient
    {
        return new ProductionDelegateClient($this->configuration);
    }

    public function pricing(): PricingDelegateClient
    {
        return new PricingDelegateClient($this->configuration);
    }

    public function stock(): StockDelegateClient
    {
        return new StockDelegateClient($this->configuration);
    }

    public function delivery(): DeliveryDelegateClient
    {
        return new DeliveryDelegateClient($this->configuration);
    }

    /**
     * @deprecated Use jobs() instead.
     */
    public function job(): JobDelegateClient
    {
        return $this->jobs();
    }

    public function jobComponent(): JobComponentDelegateClient
    {
        return new JobComponentDelegateClient($this->configuration);
    }

    public function jobQuery(): JobQueryDelegateClient
    {
        return new JobQueryDelegateClient($this->configuration);
    }

    public function jobBatch(): JobBatchDelegateClient
    {
        return new JobBatchDelegateClient($this->configuration);
    }

    public function jobFilter(): JobFilterDelegateClient
    {
        return new JobFilterDelegateClient($this->configuration);
    }

    public function product(): ProductDelegateClient
    {
        return new ProductDelegateClient($this->configuration);
    }

    public function artwork(): ArtworkDelegateClient
    {
        return new ArtworkDelegateClient($this->configuration);
    }

    public function artifact(): ArtifactDelegateClient
    {
        return new ArtifactDelegateClient($this->configuration);
    }

    public function clientWorkflow(): ClientWorkflowDelegateClient
    {
        return new ClientWorkflowDelegateClient($this->configuration);
    }
}
