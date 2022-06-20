<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;

/**
 * {@inheritdoc}
 */
class ExperimentalDelegateClient extends DelegateClient
{
    /**
     * Run an http request against an experimental (or otherwise not implemented in the sdk) endpoint.
     *
     * Example $configureRequestContextFn:
     *
     * function (RequestContext $context) {
     *      $context->prepareContextForPost('/experimental/endpoint');
     *      $context->setPayload(['endpointData': 100]);
     * }
     *
     * @param string $apiEndpointVersion E.g. "2.1" will produce "https://printedapi.com/2.1" baseurl.
     * @param callable $configureRequestContextFn (RequestContext $context) => void
     *
     * @return mixed[] json_decoded response from the server
     */
    public function executeRequest(
        string $apiEndpointVersion,
        callable $configureRequestContextFn
    ): array {
        $context = $this->configuration->createRequestContext($apiEndpointVersion);

        $configureRequestContextFn($context);

        $responseData = $this->configuration->getRequestAdapter()->request($context);

        return $responseData;
    }
}
