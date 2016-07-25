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
     * @param string $path
     */
    public function prepareContextForGet($path)
    {
        $this->method = Request::METHOD_GET;
        $this->path = sprintf('%s/%s', $this->path, ltrim($path, '/'));
    }

}
