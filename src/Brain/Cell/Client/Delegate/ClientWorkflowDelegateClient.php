<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\ClientWorkflow\ClientWorkflowResource;

class ClientWorkflowDelegateClient extends DelegateClient
{
    public function getClientWorkflow(string $id): ClientWorkflowResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/workflows/%s', $id));

        return $this->request($context, new ClientWorkflowResource());
    }

    public function postClientWorkflow(ClientWorkflowResource $clientWorkflowResource): ClientWorkflowResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/workflows');

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($clientWorkflowResource));

        return $this->request($context, $clientWorkflowResource);
    }
}
