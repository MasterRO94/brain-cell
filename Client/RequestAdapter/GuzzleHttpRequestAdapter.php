<?php

namespace Brain\Cell\Client\RequestAdapter;

use Brain\Cell\Client\RequestAdapterInterface;
use Brain\Cell\Client\RequestContext;
use Brain\Cell\Exception\RequestAdapterException;

use GuzzleHttp\ClientInterface;

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
     * @param RequestContext $context
     * @return array
     */
    public function request(RequestContext $context)
    {

        $response = $this->guzzle->request(
            $context->getMethod(),
            $context->getPath(),
            [
                'headers' => $context->getHeaders()->all()
            ]
        );

        return json_decode($response->getBody(), true);

    }

}
