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
     * @var array
     */
    protected $payload;

    /**
     * {@inheritdoc}
     */
    public function __construct($path)
    {
        $this->path = $path;

        $this->headers = new HeaderBag;
        $this->filters = new ParameterBag;
        $this->selections = new ParameterBag;
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
        $this->method = Request::METHOD_GET;
        $this->path = sprintf('%s/%s', $this->path, ltrim($path, '/'));
    }

    /**
     * @param string $path
     */
    public function prepareContextForPost($path)
    {
        $this->method = Request::METHOD_POST;
        $this->path = sprintf('%s/%s', $this->path, ltrim($path, '/'));
    }

    /**
     * @param string $path
     */
    public function prepareContextForPatch($path)
    {
        $this->method = Request::METHOD_PATCH;
        $this->path = sprintf('%s/%s', $this->path, ltrim($path, '/'));
    }
}
