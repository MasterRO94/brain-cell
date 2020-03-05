<?php

declare(strict_types=1);

namespace Brain\Cell\Client;

final class ClientConfiguration
{
    /** @var RequestAdapterInterface */
    private $requestAdapter;

    /** @var string */
    private $basePath = 'https://api.printed-api.com';

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

    public function getBasePath(string $version): string
    {
        return sprintf('%s/%s', $this->basePath, $version);
    }

    public function setBasePath(string $basePath): void
    {
        $this->basePath = $basePath;
    }

    public function createRequestContext(string $version): RequestContext
    {
        $context = new RequestContext($this->getBasePath($version));
        $context->getHeaders()->set('Authorization', sprintf('Bearer %s', $this->apiKey));
        $context->getHeaders()->set('Api-Client-Version', $version);

        return $context;
    }
}
