<?php

declare(strict_types=1);

namespace Brain\Cell;

use Brain\Cell\Client\ClientConfiguration;
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
use Brain\Cell\Client\Delegate\Job\JobGroupDelegateClient;
use Brain\Cell\Client\Delegate\Job\JobQueryDelegateClient;
use Brain\Cell\Client\Delegate\Pricing\PricingDelegateClient;
use Brain\Cell\Client\Delegate\ProductDelegateClient;
use Brain\Cell\Client\Delegate\Production\GangDelegateClient;
use Brain\Cell\Client\Delegate\Production\ProductionDelegateClient;
use Brain\Cell\Client\Delegate\StockDelegateClient;
use Brain\Cell\Client\Delegate\WebhookDelegateClient;
use Brain\Cell\Client\DelegateClient;
use Brain\Cell\Client\DelegateHelper\DeliveryDelegateClientHelper;
use Brain\Cell\Service\ResourceHandlerService;

use Psr\Container\ContainerInterface;

/**
 * {@inheritdoc}
 */
class BrainClient extends DelegateClient implements BrainClientInterface
{
    /** @var ContainerInterface */
    private $serviceContainer;

    public function __construct(ContainerInterface $serviceContainer, ClientConfiguration $clientConfiguration)
    {
        parent::__construct($clientConfiguration, $serviceContainer->get(ResourceHandlerService::class));

        $this->serviceContainer = $serviceContainer;
    }

    public function authentication(): AuthenticationDelegateClient
    {
        return $this->serviceContainer->get(AuthenticationDelegateClient::class);
    }

    public function webhooks(): WebhookDelegateClient
    {
        return $this->serviceContainer->get(WebhookDelegateClient::class);
    }

    public function jobs(): JobDelegateClient
    {
        return $this->serviceContainer->get(JobDelegateClient::class);
    }

    public function files(): FileDelegateClient
    {
        return $this->serviceContainer->get(FileDelegateClient::class);
    }

    public function productions(): ProductionDelegateClient
    {
        return $this->serviceContainer->get(ProductionDelegateClient::class);
    }

    public function gang(): GangDelegateClient
    {
        return $this->serviceContainer->get(GangDelegateClient::class);
    }

    public function pricing(): PricingDelegateClient
    {
        return $this->serviceContainer->get(PricingDelegateClient::class);
    }

    public function stock(): StockDelegateClient
    {
        return $this->serviceContainer->get(StockDelegateClient::class);
    }

    public function delivery(): DeliveryDelegateClient
    {
        return $this->serviceContainer->get(DeliveryDelegateClient::class);
    }

    public function deliveryHelper(): DeliveryDelegateClientHelper
    {
        return $this->serviceContainer->get(DeliveryDelegateClientHelper::class);
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
        return $this->serviceContainer->get(JobComponentDelegateClient::class);
    }

    public function jobQuery(): JobQueryDelegateClient
    {
        return $this->serviceContainer->get(JobQueryDelegateClient::class);
    }

    public function jobBatch(): JobBatchDelegateClient
    {
        return $this->serviceContainer->get(JobBatchDelegateClient::class);
    }

    public function jobGroup(): JobGroupDelegateClient
    {
        return $this->serviceContainer->get(JobGroupDelegateClient::class);
    }

    public function jobFilter(): JobFilterDelegateClient
    {
        return $this->serviceContainer->get(JobFilterDelegateClient::class);
    }

    public function product(): ProductDelegateClient
    {
        return $this->serviceContainer->get(ProductDelegateClient::class);
    }

    public function artwork(): ArtworkDelegateClient
    {
        return $this->serviceContainer->get(ArtworkDelegateClient::class);
    }

    public function artifact(): ArtifactDelegateClient
    {
        return $this->serviceContainer->get(ArtifactDelegateClient::class);
    }

    public function clientWorkflow(): ClientWorkflowDelegateClient
    {
        return $this->serviceContainer->get(ClientWorkflowDelegateClient::class);
    }
}
