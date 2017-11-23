<?php

namespace Brain\Cell\Client;

use Brain\Cell\Service\ResourceHandlerService;

class ClientConfiguration
{
    const VERSION = 'v1';

    /**
     * @var RequestAdapterInterface
     */
    protected $requestAdapter;

    /**
     * @var string
     */
    protected $basePath = 'https://api.printed-api.com';

    /**
     * @var ResourceHandlerService
     */
    protected $resourceHandler;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @param RequestAdapterInterface $requestAdapter
     * @param string $apiKey
     */
    public function __construct(RequestAdapterInterface $requestAdapter, $apiKey)
    {
        $this->requestAdapter = $requestAdapter;
        $this->apiKey = $apiKey;
    }

    /**
     * @return RequestAdapterInterface
     */
    public function getRequestAdapter()
    {
        return $this->requestAdapter;
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        return sprintf('%s/%s', $this->basePath, self::VERSION);
    }

    /**
     * @param string $basePath
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * @param ResourceHandlerService $resourceHandler
     */
    public function setResourceHandler(ResourceHandlerService $resourceHandler)
    {
        $this->resourceHandler = $resourceHandler;
    }

    /**
     * @return ResourceHandlerService
     */
    public function getResourceHandler()
    {
        if (!$this->resourceHandler) {
            throw new \RuntimeException("Can't retrieve a Cell resource handler, because it's not been set.");
        }

        return $this->resourceHandler;
    }

    /**
     * @return bool
     */
    public function hasResourceHandler()
    {
        return $this->resourceHandler instanceof ResourceHandlerService;
    }

    /**
     * @return RequestContext
     */
    public function createRequestContext()
    {
        $context = new RequestContext($this->getBasePath());
        $context->getHeaders()->set('Authorization', sprintf('Token %s', $this->apiKey));
        $context->getHeaders()->set('Api-Client-Version', self::VERSION);

        return $context;
    }
}
