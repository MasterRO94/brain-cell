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
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/webhook/endpoints');

        $context->setPayload($handler->serialise($webhookEndpoint));

        /** @var WebhookEndpointResourceInterface $resource */
        $resource = $this->request($context, $webhookEndpoint);

        return $resource;
    }
}
