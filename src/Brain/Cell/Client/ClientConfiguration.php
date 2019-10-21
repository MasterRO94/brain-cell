<?php

declare(strict_types=1);

namespace Brain\Cell\Client;

use Brain\Cell\Service\ResourceHandlerService;

use RuntimeException;

final class ClientConfiguration
{
    public const VERSION = 'v1';

    /** @var RequestAdapterInterface */
    private $requestAdapter;

    /** @var string */
    private $basePath = 'https://api.printed-api.com';

    /** @var ResourceHandlerService|null */
    private $resourceHandler;

    /** @var string */
    private $apiKey;

    public function __construct(RequestAdapterInterface $requestAdapter, string $apiKey)
    {
        $this->requestAdapter = $requestAdapter;
        $this->apiKey = $apiKey;
    }

    public function getRequestAdapter(): RequestAdapterInterface
    {
        return $this->requestAdapter;
    }

    public function getBasePath(string $version = self::VERSION): string
    {
        return sprintf('%s/%s', $this->basePath, $version);
    }

    public function setBasePath(string $basePath): void
    {
        $this->basePath = $basePath;
    }

    public function setResourceHandler(ResourceHandlerService $resourceHandler): void
    {
        $this->resourceHandler = $resourceHandler;
    }

    public function getResourceHandler(): ResourceHandlerService
    {
        if (!($this->resourceHandler instanceof ResourceHandlerService)) {
            throw new RuntimeException("Can't retrieve a Cell resource handler, because it's not been set.");
        }

        return $this->resourceHandler;
    }

    public function hasResourceHandler(): bool
    {
        return $this->resourceHandler instanceof ResourceHandlerService;
    }

    public function createRequestContext(string $version = self::VERSION): RequestContext
    {
        $context = new RequestContext($this->getBasePath($version));
        $context->getHeaders()->set('Authorization', sprintf('Bearer %s', $this->apiKey));
        $context->getHeaders()->set('Api-Client-Version', $version);

        return $context;
    }
}
