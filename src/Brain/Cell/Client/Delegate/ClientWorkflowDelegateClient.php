<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\ClientWorkflow\ClientWorkflowResource;
use Brain\Cell\EntityResource\Job\ClientWorkflow\ClientWorkflowResourceInterface;

class ClientWorkflowDelegateClient extends DelegateClient
{
    public function getClientWorkflow(string $id): ClientWorkflowResourceInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet(sprintf('/workflows/%s', $id));

        /** @var ClientWorkflowResource $resource */
        $resource = $this->request($context, new ClientWorkflowResource());

        return $resource;
    }

    public function postClientWorkflow(ClientWorkflowResource $clientWorkflowResource): ClientWorkflowResourceInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost('/workflows');

        $context->setPayload($this->resourceHandler->serialise($clientWorkflowResource));

        /** @var ClientWorkflowResource $resource */
        $resource = $this->request($context, $clientWorkflowResource);

        return $resource;
    }
}
