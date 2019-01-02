<?php

namespace Brain\Cell;

use Brain\Cell\Client\Delegate\ArtifactDelegateClient;
use Brain\Cell\Client\Delegate\ArtworkDelegateClient;
use Brain\Cell\Client\Delegate\AuthenticationDelegateClient;
use Brain\Cell\Client\Delegate\ClientWorkflowDelegateClient;
use Brain\Cell\Client\Delegate\DeliveryDelegateClient;
use Brain\Cell\Client\Delegate\FileDelegateClient;
use Brain\Cell\Client\Delegate\JobBatchDelegateClient;
use Brain\Cell\Client\Delegate\JobComponentDelegateClient;
use Brain\Cell\Client\Delegate\JobDelegateClient;
use Brain\Cell\Client\Delegate\JobQueryDelegateClient;
use Brain\Cell\Client\Delegate\PricingDelegateClient;
use Brain\Cell\Client\Delegate\ProductDelegateClient;
use Brain\Cell\Client\Delegate\StockDelegateClient;
use Brain\Cell\Client\DelegateClient;

/**
 * {@inheritdoc}
 */
class BrainClient extends DelegateClient
{
    /**
     * @return AuthenticationDelegateClient
     */
    public function authentication(): AuthenticationDelegateClient
    {
        return new AuthenticationDelegateClient($this->configuration);
    }

    public function file(): FileDelegateClient
    {
        return new FileDelegateClient($this->configuration);
    }

    /**
     * @return PricingDelegateClient
     */
    public function pricing(): PricingDelegateClient
    {
        return new PricingDelegateClient($this->configuration);
    }

    /**
     * @return StockDelegateClient
     */
    public function stock(): StockDelegateClient
    {
        return new StockDelegateClient($this->configuration);
    }

    /**
     * @return DeliveryDelegateClient
     */
    public function delivery(): DeliveryDelegateClient
    {
        return new DeliveryDelegateClient($this->configuration);
    }

    /**
     * @return JobDelegateClient
     */
    public function job(): JobDelegateClient
    {
        return new JobDelegateClient($this->configuration);
    }

    /**
     * @return JobComponentDelegateClient
     */
    public function jobComponent(): JobComponentDelegateClient
    {
        return new JobComponentDelegateClient($this->configuration);
    }

    /**
     * @return JobQueryDelegateClient
     */
    public function jobQuery(): JobQueryDelegateClient
    {
        return new JobQueryDelegateClient($this->configuration);
    }

    /**
     * @return JobBatchDelegateClient
     */
    public function jobBatch(): JobBatchDelegateClient
    {
        return new JobBatchDelegateClient($this->configuration);
    }

    /**
     * @return ProductDelegateClient
     */
    public function product(): ProductDelegateClient
    {
        return new ProductDelegateClient($this->configuration);
    }

    /**
     * @return ArtworkDelegateClient
     */
    public function artwork(): ArtworkDelegateClient
    {
        return new ArtworkDelegateClient($this->configuration);
    }

    /**
     * @return ArtifactDelegateClient
     */
    public function artifact(): ArtifactDelegateClient
    {
        return new ArtifactDelegateClient($this->configuration);
    }

    /**
     * @return ClientWorkflowDelegateClient
     */
    public function clientWorkflow(): ClientWorkflowDelegateClient
    {
        return new ClientWorkflowDelegateClient($this->configuration);
    }
}
