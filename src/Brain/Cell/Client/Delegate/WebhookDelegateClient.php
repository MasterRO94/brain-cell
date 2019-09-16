<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\WebhookEndpointResource;

class WebhookDelegateClient extends DelegateClient
{
    public function postWebhookEndpoint(
        WebhookEndpointResource $webhookEndpoint
    ): WebhookEndpointResource {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/webhook/endpoints');

        $context->setPayload($handler->serialise($webhookEndpoint));

        /** @var JobBatchResourceInterface $resource */
        $resource = $this->request($context, $webhookEndpoint);

        return $resource;
    }
}
