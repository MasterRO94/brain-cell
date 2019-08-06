<?php

declare(strict_types=1);

namespace Brain\Cell\Client;

use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class RequestContext
{
    /** @var string */
    protected $method;

    /** @var string */
    protected $path;

    /** @var HeaderBag */
    protected $headers;

    /** @var ParameterBag */
    protected $filters;

    /** @var ParameterBag */
    protected $selections;

    /** @var ParameterBag */
    protected $parameters;

    /** @var mixed[] */
    protected $payload;

    public function __construct(string $path)
    {
        $this->path = $path;

        $this->headers = new HeaderBag();
        $this->filters = new ParameterBag();
        $this->selections = new ParameterBag();
        $this->parameters = new ParameterBag();
        $this->payload = [];
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getHeaders(): HeaderBag
    {
        return $this->headers;
    }

    public function getFilters(): ParameterBag
    {
        return $this->filters;
    }

    public function getParameters(): ParameterBag
    {
        return $this->parameters;
    }

    /**
     * @return mixed[]
     */
    public function getPayload(): array
    {
        return $this->payload;
    }

    /**
     * @param mixed[] $payload
     */
    public function setPayload(array $payload): RequestContext
    {
        $this->payload = $payload;

        return $this;
    }

    public function prepareContextForGet(string $path): void
    {
        $this->prepareContext(Request::METHOD_GET, $path);
    }

    public function prepareContextForPost(string $path): void
    {
        $this->prepareContext(Request::METHOD_POST, $path);
    }

    public function prepareContextForPut(string $path): void
    {
        $this->prepareContext(Request::METHOD_PUT, $path);
    }

    public function prepareContextForDelete(string $path): void
    {
        $this->prepareContext(Request::METHOD_DELETE, $path);
    }

    public function prepareContextForPatch(string $path): void
    {
        $this->prepareContext(Request::METHOD_PATCH, $path);
    }

    public function prepareContextForLink(string $path): void
    {
        $this->prepareContext('LINK', $path);
    }

    public function prepareContextForUnlink(string $path): void
    {
        $this->prepareContext('UNLINK', $path);
    }

    public function prepareContext(string $httpRequestMethod, string $path): void
    {
        $this->method = $httpRequestMethod;
        $this->path = sprintf('%s/%s', $this->path, ltrim($path, '/'));
    }

    public function hasPayload(): bool
    {
        return $this->payload !== null;
    }
}
