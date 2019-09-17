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
use Brain\Cell\Client\Delegate\Job\JobQueryDelegateClient;
use Brain\Cell\Client\Delegate\Pricing\PricingDelegateClient;
use Brain\Cell\Client\Delegate\ProductDelegateClient;
use Brain\Cell\Client\Delegate\Production\ProductionDelegateClient;
use Brain\Cell\Client\Delegate\StockDelegateClient;
use Brain\Cell\Client\Delegate\WebhookDelegateClient;

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
