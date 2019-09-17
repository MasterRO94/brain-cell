<?php

declare(strict_types=1);

namespace Brain\Cell;

interface BrainClientInterface
{
    public function authentication(): AuthenticationDelegateClient;

    public function webhooks(): WebhookDelegateClient;

    public function jobs(): JobDelegateClient;

    public function files(): FileDelegateClient;

    public function productions(): ProductionDelegateClient;

    public function pricing(): PricingDelegateClient;

    public function stock(): StockDelegateClient;

    public function delivery(): DeliveryDelegateClient;

    public function jobComponent(): JobComponentDelegateClient;

    public function jobQuery(): JobQueryDelegateClient;

    public function jobBatch(): JobBatchDelegateClient;

    public function product(): ProductDelegateClient;

    public function artwork(): ArtworkDelegateClient;

    public function artifact(): ArtifactDelegateClient;

    public function clientWorkflow(): ClientWorkflowDelegateClient;
}
