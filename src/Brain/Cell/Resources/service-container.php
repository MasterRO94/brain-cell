<?php

namespace Brain\Cell\Resources;

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
use Brain\Cell\Client\Delegate\Job\JobQueryDelegateClient;
use Brain\Cell\Client\Delegate\Pricing\PricingDelegateClient;
use Brain\Cell\Client\Delegate\ProductDelegateClient;
use Brain\Cell\Client\Delegate\Production\ProductionDelegateClient;
use Brain\Cell\Client\Delegate\StockDelegateClient;
use Brain\Cell\Client\Delegate\WebhookDelegateClient;
use Brain\Cell\Client\DelegateHelper\DeliveryDelegateClientHelper;
use Brain\Cell\Service\CellServiceContainer;
use Brain\Cell\Service\ResourceHandlerService;
use Brain\Cell\Transfer\EntityResourceFactory;
use Brain\Cell\Transformer\ArrayDecoder;
use Brain\Cell\Transformer\ArrayEncoder;

function createServiceContainer(ClientConfiguration $clientConfiguration): CellServiceContainer
{
    $servicesCreateFunctions = [
        /*
         * Basics
         */

        ClientConfiguration::class => function (CellServiceContainer $serviceContainer) use ($clientConfiguration) {
            return $clientConfiguration;
        },
        ResourceHandlerService::class => function (CellServiceContainer $serviceContainer) {
            return new ResourceHandlerService(
                new EntityResourceFactory(),
                new ArrayEncoder(),
                new ArrayDecoder()
            );
        },

        /*
         * DelegateClients
         */

        AuthenticationDelegateClient::class => function (CellServiceContainer $serviceContainer) {
            return new AuthenticationDelegateClient($serviceContainer->get(ClientConfiguration::class));
        },
        WebhookDelegateClient::class => function (CellServiceContainer $serviceContainer) {
            return new WebhookDelegateClient($serviceContainer->get(ClientConfiguration::class));
        },
        JobDelegateClient::class => function (CellServiceContainer $serviceContainer) {
            return new JobDelegateClient($serviceContainer->get(ClientConfiguration::class));
        },
        FileDelegateClient::class => function (CellServiceContainer $serviceContainer) {
            return new FileDelegateClient($serviceContainer->get(ClientConfiguration::class));
        },
        ProductionDelegateClient::class => function (CellServiceContainer $serviceContainer) {
            return new ProductionDelegateClient($serviceContainer->get(ClientConfiguration::class));
        },
        PricingDelegateClient::class => function (CellServiceContainer $serviceContainer) {
            return new PricingDelegateClient($serviceContainer->get(ClientConfiguration::class));
        },
        StockDelegateClient::class => function (CellServiceContainer $serviceContainer) {
            return new StockDelegateClient($serviceContainer->get(ClientConfiguration::class));
        },
        DeliveryDelegateClient::class => function (CellServiceContainer $serviceContainer) {
            return new DeliveryDelegateClient($serviceContainer->get(ClientConfiguration::class));
        },
        JobComponentDelegateClient::class => function (CellServiceContainer $serviceContainer) {
            return new JobComponentDelegateClient($serviceContainer->get(ClientConfiguration::class));
        },
        JobQueryDelegateClient::class => function (CellServiceContainer $serviceContainer) {
            return new JobQueryDelegateClient($serviceContainer->get(ClientConfiguration::class));
        },
        JobBatchDelegateClient::class => function (CellServiceContainer $serviceContainer) {
            return new JobBatchDelegateClient($serviceContainer->get(ClientConfiguration::class));
        },
        JobFilterDelegateClient::class => function (CellServiceContainer $serviceContainer) {
            return new JobFilterDelegateClient($serviceContainer->get(ClientConfiguration::class));
        },
        ProductDelegateClient::class => function (CellServiceContainer $serviceContainer) {
            return new ProductDelegateClient($serviceContainer->get(ClientConfiguration::class));
        },
        ArtworkDelegateClient::class => function (CellServiceContainer $serviceContainer) {
            return new ArtworkDelegateClient($serviceContainer->get(ClientConfiguration::class));
        },
        ArtifactDelegateClient::class => function (CellServiceContainer $serviceContainer) {
            return new ArtifactDelegateClient($serviceContainer->get(ClientConfiguration::class));
        },
        ClientWorkflowDelegateClient::class => function (CellServiceContainer $serviceContainer) {
            return new ClientWorkflowDelegateClient($serviceContainer->get(ClientConfiguration::class));
        },

        /*
         * The rest
         */

        DeliveryDelegateClientHelper::class => function (CellServiceContainer $serviceContainer) {
            return new DeliveryDelegateClientHelper($serviceContainer->get(DeliveryDelegateClient::class));
        },
    ];

    $serviceContainer = new CellServiceContainer();

    foreach ($servicesCreateFunctions as $serviceName => $serviceCreateFunction) {
        $serviceContainer->set($serviceName, $serviceCreateFunction);
    }

    return $serviceContainer;
}
