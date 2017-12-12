<?php

namespace Brain\Cell;

use Brain\Cell\Client\Delegate\ArtworkDelegateClient;
use Brain\Cell\Client\Delegate\ChangeDelegateClient;
use Brain\Cell\Client\Delegate\DeliveryDelegateClient;
use Brain\Cell\Client\Delegate\JobBatchDelegateClient;
use Brain\Cell\Client\Delegate\JobDelegateClient;
use Brain\Cell\Client\Delegate\PricingDelegateClient;
use Brain\Cell\Client\Delegate\ProductDelegateClient;
use Brain\Cell\Client\Delegate\StockDelegateClient;
use Brain\Cell\Client\DelegateClient;
use Brain\Cell\Client\Delegate\ArtifactDelegateClient;

/**
 * {@inheritdoc}
 */
class BrainClient extends DelegateClient
{
    /**
     * @return PricingDelegateClient
     */
    public function pricing()
    {
        return new PricingDelegateClient($this->configuration);
    }

    /**
     * @return StockDelegateClient
     */
    public function stock()
    {
        return new StockDelegateClient($this->configuration);
    }

    /**
     * @return DeliveryDelegateClient
     */
    public function delivery()
    {
        return new DeliveryDelegateClient($this->configuration);
    }

    /**
     * @return JobDelegateClient
     */
    public function job()
    {
        return new JobDelegateClient($this->configuration);
    }

    /**
     * @return JobBatchDelegateClient
     */
    public function jobBatch()
    {
        return new JobBatchDelegateClient($this->configuration);
    }

    /**
     * @return ProductDelegateClient
     */
    public function product()
    {
        return new ProductDelegateClient($this->configuration);
    }

    /**
     * @return ArtworkDelegateClient
     */
    public function artwork()
    {
        return new ArtworkDelegateClient($this->configuration);
    }

    /**
     * @return ChangeDelegateClient
     */
    public function change()
    {
        return new ChangeDelegateClient($this->configuration);
    }

    /**
     * @return ArtifactDelegateClient
     */
    public function artifact()
    {
        return new ArtifactDelegateClient($this->configuration);
    }
}
