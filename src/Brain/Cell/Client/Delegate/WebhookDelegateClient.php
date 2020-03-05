<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\WebhookEndpointResourceInterface;

final class WebhookDelegateClient extends DelegateClient
{
    public function postWebhookEndpoint(
        WebhookEndpointResourceInterface $webhookEndpoint
    ): WebhookEndpointResourceInterface {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost('/webhook/endpoints');

        $context->setPayload($this->resourceHandler->serialise($webhookEndpoint));

        /** @var WebhookEndpointResourceInterface $resource */
        $resource = $this->request($context, $webhookEndpoint);

        return $resource;
    }
}
