<?php

declare(strict_types=1);

namespace Brain\Cell\Client\RequestAdapter;

use Brain\Cell\Client\RequestAdapterInterface;
use Brain\Cell\Client\RequestContext;
use Brain\Cell\Exception\Request\BadRequestException;
use Brain\Cell\Exception\Request\NotFoundException;
use Brain\Cell\Exception\Request\PayloadViolationException;
use Brain\Cell\Exception\Request\StatusTransitionException;
use Brain\Cell\Exception\Request\UnknownRequestException;
use Brain\Cell\Response\ErrorMessageEnum;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Throwable;

/**
 * {@inheritdoc}
 */
class GuzzleHttpRequestAdapter implements RequestAdapterInterface
{
    public const VERSION_MINIMUM = 6.2;

    protected $guzzle;

    public function __construct(ClientInterface $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    /**
     * {@inheritdoc}
     */
    public function request(RequestContext $context): array
    {
        $response = $this->getResponse($context);

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    public function stream(RequestContext $context): StreamInterface
    {
        $response = $this->getResponse($context);

        return $response->getBody();
    }

    /**
     * @throws Throwable
     */
    protected function getResponse(RequestContext $context): ResponseInterface
    {
        $path = $context->getPath();
        $parameters = $context->getParameters()->all();

        if ($context->getFilters()->count()) {
            $parameters = array_merge(
                $parameters,
                [
                    'filter' => $context->getFilters()->all(),
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
     */
    protected function wrapResponseException(Throwable $exception): Throwable
    {
        // If the exception isn't from Guzzle then return the original.
        if (!$exception instanceof RequestException) {
            return $exception;
        }

        $method = $exception->getRequest()->getMethod();
        $uri = (string) $exception->getRequest()->getUri();
        $requestContent = $exception->getRequest()->getBody()->getContents();
        $responseContent = $exception->getResponse()->getBody()->getContents();

        $requestPayload = json_decode($requestContent, true);
        $responsePayload = json_decode($responseContent, true);

        // If we cannot read the body of the response then throw the original error.
        if ($responsePayload === null) {
            return $exception;
        }

        // Attempt to fetch the canonical error, we can map exceptions on that.
        $canonical = $responsePayload['error']['canonical'] ?? null;

        // Decorate exceptions according to status code and potentially canonical.
        switch ($exception->getResponse()->getStatusCode()) {
            // Bad Request.
            case 400:
                if ($canonical === null) {
                    return new BadRequestException(
                        sprintf('%s %s: %s', $method, $uri, $responseContent),
                        $requestPayload,
                        $responsePayload,
                        $exception
                    );
                }

                // If we don't recognise the canonical we can still use the message
                $message = $responsePayload['error']['message'] ?? null;
                switch ($canonical) {
                    case ErrorMessageEnum::ERROR_PAYLOAD_VIOLATION:
                        $violations = json_encode($responsePayload['violations'] ?? []);

                        return new PayloadViolationException(
                            sprintf('%s %s: %s', $method, $uri, $violations),
                            $requestPayload,
                            $responsePayload,
                            $exception
                        );

                    case ErrorMessageEnum::ERROR_STATUS_TRANSITION:
                        return new StatusTransitionException(
                            sprintf(
                                '%s %s: %s',
                                $method,
                                $uri,
                                $message ?? $responseContent
                            ),
                            $requestPayload,
                            $responsePayload,
                            $exception
                        );

                    default:
                        return new BadRequestException(
                            sprintf(
                                '%s %s: %s',
                                $method,
                                $uri,
                                $message ?? $responseContent
                            ),
                            $requestPayload,
                            $responsePayload,
                            $exception
                        );
                }

            // Not Found.
            // no break
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
