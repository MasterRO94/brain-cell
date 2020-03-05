<?php

declare(strict_types=1);

namespace Brain\Cell;

use Brain\Cell\Client\ClientConfiguration;
use Brain\Cell\Resources\ServiceContainerBuilder;

/**
 * Creates an instance of BrainClient.
 */
class BrainClientFactory
{
    public function createBrainClient(ClientConfiguration $clientConfiguration): BrainClient
    {
        $serviceContainer = ServiceContainerBuilder::buildServiceContainer($clientConfiguration);

        return new BrainClient($serviceContainer, $clientConfiguration);
    }
}
