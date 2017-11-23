<?php

namespace Brain\Cell\Client\RequestAdapter;

use Brain\Cell\Client\RequestAdapterInterface;
use Brain\Cell\Client\RequestContext;
use Brain\Cell\Exception\Request\BadRequestException;
use Brain\Cell\Exception\Request\NotFoundException;
use Brain\Cell\Exception\Request\PayloadViolationException;
use Brain\Cell\Exception\Request\UnknownRequestException;
use Brain\Cell\Exception\RequestAdapterException;
use Brain\Cell\Response\ErrorMessageEnum;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

/**
 * {@inheritdoc}
 */
class GuzzleHttpRequestAdapter implements RequestAdapterInterface
{
    const VERSION_MINIMUM = 6.2;

    protected $guzzle;

    /**
     * Constructor.
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
     *
     * @return ResponseInterface
     *
     * @throws \Exception
     */
    protected function getResponse(RequestContext $context)
    {
        $path = $context->getPath();
        $parameters = $context->getParameters()->all();

        if ($context->getFilters()->count()) {
            $parameters = array_merge(
                $parameters,
                [
                    'filters' => $context->getFilters()->all(),
                ]
            );
        }

        if (count($parameters)) {
            $path = sprintf('%s?%s', $path, urldecode(http_build_query($parameters)));
        }

        $options = [
            'headers' => $context->getHeaders()->all(),
        ];

        if ($context->hasPayload()) {
            $options['json'] = $context->getPayload();
        }

        try {
            $method = $context->getMethod();
            $response = $this->guzzle->request($method, $path, $options);
        } catch (GuzzleException $exception) {
            $wrapped = $this->wrapResponseException($exception);

            throw $wrapped;
        }

        return $response;
    }

    /**
     * Wrap the exception from Guzzle.
     *
     * @param \Exception $exception
     *
     * @return \Exception
     */
    protected function wrapResponseException(\Exception $exception): \Exception
    {
        //  If the exception isn't from Guzzle then return the original.
        if (!$exception instanceof RequestException) {
            return $exception;
        }

        $method = $exception->getRequest()->getMethod();
        $uri = (string) $exception->getRequest()->getUri();
        $requestContent = $exception->getRequest()->getBody()->getContents();
        $responseContent = $exception->getResponse()->getBody()->getContents();

        $requestPayload = json_decode($requestContent, true);
        $responsePayload = json_decode($responseContent, true);

        //  If we cannot read the body of the response then throw the original error.
        if (is_null($responsePayload)) {
            return $exception;
        }

        //  Attempt to fetch the canonical error, we can map exceptions on that.
        $canonical = $responsePayload['error']['canonical'] ?? null;

        //  Decorate exceptions according to status code and potentially canonical.
        switch ($exception->getResponse()->getStatusCode()) {

            //  Bad Request.
            case 400:
                if (ErrorMessageEnum::ERROR_PAYLOAD_VIOLATION === $canonical) {
                    return new PayloadViolationException(
                        sprintf('%s %s: %s', $method, $uri, $responseContent),
                        $requestPayload,
                        $responsePayload,
                        $exception
                    );
                }

                return new BadRequestException(
                    sprintf('%s %s: %s', $method, $uri, $responseContent),
                    $requestPayload,
                    $responsePayload,
                    $exception
                );

            //  Not Found.
            case 404:
                return new NotFoundException(
                    sprintf('%s %s', $method, $uri),
                    $requestPayload,
                    $responsePayload,
                    $exception
                );

            default:
                throw new UnknownRequestException(
                    sprintf('%s %s: %s', $method, $uri, $responseContent),
                    $exception->getResponse()->getStatusCode(),
                    $requestPayload,
                    $responsePayload,
                    $exception
                );

        }
    }
}
