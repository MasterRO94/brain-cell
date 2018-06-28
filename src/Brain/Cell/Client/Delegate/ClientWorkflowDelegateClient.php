<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\ClientWorkflow\ClientWorkflowResource;

class ClientWorkflowDelegateClient extends DelegateClient
{

    /**
     * @param string $id
     *
     * @return ClientWorkflowResource
     */
    public function getClientWorkflow(string $id)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/workflows/%s', $id));

        return $this->request($context, new ClientWorkflowResource());
    }

    /**
     * @param ClientWorkflowResource $clientWorkflowResource
     *
     * @return ClientWorkflowResource
     */
    public function postClientWorkflow(ClientWorkflowResource $clientWorkflowResource)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/workflows');

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($clientWorkflowResource));

        return $this->request($context, $clientWorkflowResource);
    }
}
