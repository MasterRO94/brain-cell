<?php

namespace Brain\Cell\Client\RequestAdapter;

use Brain\Cell\Client\RequestAdapterInterface;
use Brain\Cell\Client\RequestContext;
use Brain\Cell\Exception\RequestAdapterException;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\StreamInterface;

class GuzzleHttpRequestAdapter implements RequestAdapterInterface
{

    const VERSION_MINIMUM = 6.2;

    /**
     * @var ClientInterface
     */
    protected $guzzle;

    /**
     * {@inheritdoc}
     *
     * @param ClientInterface $guzzle
     */
    public function __construct(ClientInterface $guzzle)
    {
        $this->guzzle = $guzzle;

        if (version_compare($guzzle::VERSION, static::VERSION_MINIMUM) === -1) {
            throw new RequestAdapterException(
                sprintf(
                    'The minimum supported version of "GuzzleHttp" is "%s" where "%s" was supplied',
                    static::VERSION_MINIMUM,
                    $guzzle::VERSION
                )
            );
        }

    }

    /**
     * {@inheritdoc}
     */
    public function request(RequestContext $context)
    {
        $response = $this->getResponse($context);
        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    public function stream(RequestContext $context)
    {
        $response = $this->getResponse($context);
        return $response->getBody();
    }

    /**
     * @param RequestContext $context
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function getResponse(RequestContext $context)
    {
        $path = $context->getPath();
        $parameters = $context->getParameters()->all();

        if ($context->getFilters()->count()) {
            $parameters = array_merge(
                $parameters,
                [
                    'filters' => $context->getFilters()->all()
                ]
            );
        }

        if (count($parameters)) {
            $path = sprintf('%s?%s', $path, urldecode(http_build_query($parameters)));
        }

        $options = [
            'headers' => $context->getHeaders()->all()
        ];

        if ($context->hasPayload()) {
            $options['json'] = $context->getPayload();
        }

        return $this->guzzle->request(
            $context->getMethod(),
            $path,
            $options
        );
    }
}
