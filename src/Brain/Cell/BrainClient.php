<?php

namespace Brain\Cell;

use Brain\Cell\Client\Delegate\ArtifactDelegateClient;
use Brain\Cell\Client\Delegate\ArtworkDelegateClient;
use Brain\Cell\Client\Delegate\ChangeDelegateClient;
use Brain\Cell\Client\Delegate\DeliveryDelegateClient;
use Brain\Cell\Client\Delegate\JobBatchDelegateClient;
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
     * @return ChangeDelegateClient
     */
    public function change(): ChangeDelegateClient
    {
        return new ChangeDelegateClient($this->configuration);
    }

    /**
     * @return ArtifactDelegateClient
     */
    public function artifact(): ArtifactDelegateClient
    {
        return new ArtifactDelegateClient($this->configuration);
    }
}
