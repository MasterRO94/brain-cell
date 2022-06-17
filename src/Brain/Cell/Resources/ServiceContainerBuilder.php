<?php

declare(strict_types=1);

namespace Brain\Cell\Resources;

use Brain\Cell\Client\ClientConfiguration;
use Brain\Cell\Client\Delegate\ArtifactDelegateClient;
use Brain\Cell\Client\Delegate\ArtworkDelegateClient;
use Brain\Cell\Client\Delegate\AuthenticationDelegateClient;
use Brain\Cell\Client\Delegate\ClientWorkflowDelegateClient;
use Brain\Cell\Client\Delegate\DeliveryDelegateClient;
use Brain\Cell\Client\Delegate\ExperimentalDelegateClient;
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
use Brain\Cell\Client\DelegateHelper\DeliveryDelegateClientHelper;
use Brain\Cell\Service\CellServiceContainer;
use Brain\Cell\Service\ResourceHandlerService;
use Brain\Cell\Transfer\EntityResourceFactory;
use Brain\Cell\Transformer\ArrayDecoder;
use Brain\Cell\Transformer\ArrayEncoder;

class ServiceContainerBuilder
{
    public static function buildServiceContainer(ClientConfiguration $clientConfiguration): CellServiceContainer
    {
        $servicesCreateFunctions = [
            /*
             * Basics
             */

            ClientConfiguration::class => static function (CellServiceContainer $serviceContainer) use ($clientConfiguration) {
                return $clientConfiguration;
            },
            ResourceHandlerService::class => static function (CellServiceContainer $serviceContainer) {
                return new ResourceHandlerService(
                    new EntityResourceFactory(),
                    new ArrayEncoder(),
                    new ArrayDecoder()
                );
            },

            /*
             * DelegateClients
             */

            AuthenticationDelegateClient::class => static function (CellServiceContainer $serviceContainer) {
                return new AuthenticationDelegateClient(
                    $serviceContainer->get(ClientConfiguration::class),
                    $serviceContainer->get(ResourceHandlerService::class)
                );
            },
            WebhookDelegateClient::class => static function (CellServiceContainer $serviceContainer) {
                return new WebhookDelegateClient(
                    $serviceContainer->get(ClientConfiguration::class),
                    $serviceContainer->get(ResourceHandlerService::class)
                );
            },
            JobDelegateClient::class => static function (CellServiceContainer $serviceContainer) {
                return new JobDelegateClient(
                    $serviceContainer->get(ClientConfiguration::class),
                    $serviceContainer->get(ResourceHandlerService::class)
                );
            },
            FileDelegateClient::class => static function (CellServiceContainer $serviceContainer) {
                return new FileDelegateClient(
                    $serviceContainer->get(ClientConfiguration::class),
                    $serviceContainer->get(ResourceHandlerService::class)
                );
            },
            ProductionDelegateClient::class => static function (CellServiceContainer $serviceContainer) {
                return new ProductionDelegateClient(
                    $serviceContainer->get(ClientConfiguration::class),
                    $serviceContainer->get(ResourceHandlerService::class)
                );
            },
            GangDelegateClient::class => static function (CellServiceContainer $serviceContainer) {
                return new GangDelegateClient(
                    $serviceContainer->get(ClientConfiguration::class),
                    $serviceContainer->get(ResourceHandlerService::class)
                );
            },
            PricingDelegateClient::class => static function (CellServiceContainer $serviceContainer) {
                return new PricingDelegateClient(
                    $serviceContainer->get(ClientConfiguration::class),
                    $serviceContainer->get(ResourceHandlerService::class)
                );
            },
            StockDelegateClient::class => static function (CellServiceContainer $serviceContainer) {
                return new StockDelegateClient(
                    $serviceContainer->get(ClientConfiguration::class),
                    $serviceContainer->get(ResourceHandlerService::class)
                );
            },
            DeliveryDelegateClient::class => static function (CellServiceContainer $serviceContainer) {
                return new DeliveryDelegateClient(
                    $serviceContainer->get(ClientConfiguration::class),
                    $serviceContainer->get(ResourceHandlerService::class)
                );
            },
            ExperimentalDelegateClient::class => static function (CellServiceContainer $serviceContainer) {
                return new ExperimentalDelegateClient(
                    $serviceContainer->get(ClientConfiguration::class),
                    $serviceContainer->get(ResourceHandlerService::class)
                );
            },
            JobComponentDelegateClient::class => static function (CellServiceContainer $serviceContainer) {
                return new JobComponentDelegateClient(
                    $serviceContainer->get(ClientConfiguration::class),
                    $serviceContainer->get(ResourceHandlerService::class)
                );
            },
            JobQueryDelegateClient::class => static function (CellServiceContainer $serviceContainer) {
                return new JobQueryDelegateClient(
                    $serviceContainer->get(ClientConfiguration::class),
                    $serviceContainer->get(ResourceHandlerService::class)
                );
            },
            JobBatchDelegateClient::class => static function (CellServiceContainer $serviceContainer) {
                return new JobBatchDelegateClient(
                    $serviceContainer->get(ClientConfiguration::class),
                    $serviceContainer->get(ResourceHandlerService::class)
                );
            },
            JobFilterDelegateClient::class => static function (CellServiceContainer $serviceContainer) {
                return new JobFilterDelegateClient(
                    $serviceContainer->get(ClientConfiguration::class),
                    $serviceContainer->get(ResourceHandlerService::class)
                );
            },
            ProductDelegateClient::class => static function (CellServiceContainer $serviceContainer) {
                return new ProductDelegateClient(
                    $serviceContainer->get(ClientConfiguration::class),
                    $serviceContainer->get(ResourceHandlerService::class)
                );
            },
            ArtworkDelegateClient::class => static function (CellServiceContainer $serviceContainer) {
                return new ArtworkDelegateClient(
                    $serviceContainer->get(ClientConfiguration::class),
                    $serviceContainer->get(ResourceHandlerService::class)
                );
            },
            ArtifactDelegateClient::class => static function (CellServiceContainer $serviceContainer) {
                return new ArtifactDelegateClient(
                    $serviceContainer->get(ClientConfiguration::class),
                    $serviceContainer->get(ResourceHandlerService::class)
                );
            },
            ClientWorkflowDelegateClient::class => static function (CellServiceContainer $serviceContainer) {
                return new ClientWorkflowDelegateClient(
                    $serviceContainer->get(ClientConfiguration::class),
                    $serviceContainer->get(ResourceHandlerService::class)
                );
            },
            JobGroupDelegateClient::class => static function (CellServiceContainer $serviceContainer) {
                return new JobGroupDelegateClient(
                    $serviceContainer->get(ClientConfiguration::class),
                    $serviceContainer->get(ResourceHandlerService::class)
                );
            },

            /*
             * The rest
             */

            DeliveryDelegateClientHelper::class => static function (CellServiceContainer $serviceContainer) {
                return new DeliveryDelegateClientHelper($serviceContainer->get(DeliveryDelegateClient::class));
            },
        ];

        $serviceContainer = new CellServiceContainer();

        foreach ($servicesCreateFunctions as $serviceName => $serviceCreateFunction) {
            $serviceContainer->set($serviceName, $serviceCreateFunction);
        }

        return $serviceContainer;
    }
}
