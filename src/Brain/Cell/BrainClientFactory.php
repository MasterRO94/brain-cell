<?php

declare(strict_types=1);

namespace Brain\Cell;

use Brain\Cell\Client\ClientConfiguration;
use Brain\Cell\Service\ResourceHandlerService;
use function Brain\Cell\Resources\createServiceContainer;

/**
 * Creates an instance of BrainClient.
 */
class BrainClientFactory
{
    public function createBrainClient(ClientConfiguration $clientConfiguration): BrainClient
    {
        require_once __DIR__ . '/Resources/service-container.php';
        $serviceContainer = createServiceContainer($clientConfiguration);

        $clientConfiguration->setResourceHandler($serviceContainer->get(ResourceHandlerService::class));

        return new BrainClient($serviceContainer, $clientConfiguration);
    }
}
