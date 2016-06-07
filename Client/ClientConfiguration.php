<?php

namespace Brain\Cell\Client;

use Brain\Cell\Service\ResourceHandlerService;

class ClientConfiguration
{

    const VERSION = '0.1';

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
     * {@inheritdoc}
     *
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
        return $this->basePath;
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
        return $this->resourceHandler;
    }

    /**
     * @return bool
     */
    public function hasResourceHandler()
    {
        return ($this->resourceHandler instanceof ResourceHandlerService);
    }

    /**
     * @return RequestContext
     */
    public function createRequestContext()
    {
        $context = new RequestContext($this->getBasePath());
        $context->getHeaders()->set('Authorization', $this->apiKey);
        $context->getHeaders()->set('Api-Client-Version', self::VERSION);
        return $context;
    }

}
