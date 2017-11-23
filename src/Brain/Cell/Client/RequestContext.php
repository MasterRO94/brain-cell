<?php

namespace Brain\Cell\Client;

use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class RequestContext
{
    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var HeaderBag
     */
    protected $headers;

    /**
     * @var ParameterBag
     */
    protected $filters;

    /**
     * @var ParameterBag
     */
    protected $selections;

    /**
     * @var ParameterBag
     */
    protected $parameters;

    /**
     * @var array
     */
    protected $payload;


    public function __construct($path)
    {
        $this->path = $path;

        $this->headers = new HeaderBag();
        $this->filters = new ParameterBag();
        $this->selections = new ParameterBag();
        $this->parameters = new ParameterBag();
        $this->payload = [];
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return HeaderBag
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return ParameterBag
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @return ParameterBag
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return array
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param array $payload
     *
     * @return RequestContext
     */
    public function setPayload(array $payload)
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * @param string $path
     */
    public function prepareContextForGet($path)
    {
        $this->prepareContext(Request::METHOD_GET, $path);
    }

    /**
     * @param string $path
     */
    public function prepareContextForPost($path)
    {
        $this->prepareContext(Request::METHOD_POST, $path);
    }

    /**
     * @param string $path
     */
    public function prepareContextForPut($path)
    {
        $this->prepareContext(Request::METHOD_PUT, $path);
    }

    /**
     * @param string $path
     */
    public function prepareContextForPatch($path)
    {
        $this->prepareContext(Request::METHOD_PATCH, $path);
    }

    /**
     * @param string $httpRequestMethod
     * @param string $path
     */
    public function prepareContext($httpRequestMethod, $path)
    {
        $this->method = $httpRequestMethod;
        $this->path = sprintf('%s/%s', $this->path, ltrim($path, '/'));
    }

    /**
     * @return bool
     */
    public function hasPayload()
    {
        return null !== $this->payload;
    }
}
