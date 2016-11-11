<?php

namespace Brain\Cell\Client\RequestAdapter;

use Brain\Cell\Client\RequestAdapterInterface;
use Brain\Cell\Client\RequestContext;
use Brain\Cell\Exception\RequestAdapterException;

use Symfony\Component\HttpFoundation\Request;

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
        $path = $context->getPath();
        $parameters = [
            // 'XDEBUG_SESSION_START' => 'phpstorm',
        ];

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

        if ($context->getMethod() === Request::METHOD_POST) {
            $options['json'] = $context->getPayload();
        }

        $response = $this->guzzle->request(
            $context->getMethod(),
            $path,
            $options
        );

        return json_decode($response->getBody(), true);

    }

}
