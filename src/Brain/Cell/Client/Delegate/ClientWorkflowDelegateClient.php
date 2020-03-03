<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\ClientWorkflow\ClientWorkflowResource;

class ClientWorkflowDelegateClient extends DelegateClient
{
    public function getClientWorkflow(string $id): ClientWorkflowResource
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet(sprintf('/workflows/%s', $id));

        /** @var ClientWorkflowResource $resource */
        $resource = $this->request($context, new ClientWorkflowResource());

        return $resource;
    }

    public function postClientWorkflow(ClientWorkflowResource $clientWorkflowResource): ClientWorkflowResource
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost('/workflows');

        $context->setPayload($this->resourceHandler->serialise($clientWorkflowResource));

        /** @var ClientWorkflowResource $resource */
        $resource = $this->request($context, $clientWorkflowResource);

        return $resource;
    }
}
