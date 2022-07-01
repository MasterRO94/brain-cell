<?php

declare(strict_types=1);

namespace Brain\Cell\Client;

use Brain\Cell\Service\ResourceHandlerService;
use Brain\Cell\TransferEntityInterface;

use Psr\Http\Message\StreamInterface;

abstract class DelegateClient
{
    protected const VERSION_V1 = '1.0';
    protected const VERSION_V2 = '2.0';

    /** @var ClientConfiguration */
    protected $configuration;

    /** @var ResourceHandlerService */
    protected $resourceHandler;

    public function __construct(
        ClientConfiguration $configuration,
        ResourceHandlerService $resourceHandler
    ) {
        $this->configuration = $configuration;
        $this->resourceHandler = $resourceHandler;
    }

    final protected function request(
        RequestContext $context,
        TransferEntityInterface $resource
    ): TransferEntityInterface {
        $response = $this->configuration->getRequestAdapter()->request($context);

        return $this->resourceHandler->deserialise($resource, $response);
    }

    /**
     * @param RequestContext[] $requestContexts
     *
     * @return mixed[]
     */
    final protected function requestAsync(
        array $requestContexts,
        string $resourceClassName
    ): array {
        $responses = $this->configuration->getRequestAdapter()->requestAsync($requestContexts);

        $results = [];

        foreach ($responses as $key => $response) {
            $resource = new $resourceClassName();

            $results[$key] = $this->resourceHandler->deserialise($resource, $response);
        }

        return $results;
    }

    protected function stream(RequestContext $context): StreamInterface
    {
        return $this->configuration->getRequestAdapter()->stream($context);
    }
}
