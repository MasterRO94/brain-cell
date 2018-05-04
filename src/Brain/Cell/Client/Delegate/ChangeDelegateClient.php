<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Change\ChangeSetResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

class ChangeDelegateClient extends DelegateClient
{
    /**
     * @param array $parameters
     *
     * @return ChangeSetResource[]|ResourceCollection
     */
    public function getChangeSets(array $parameters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/change-sets');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(ChangeSetResource::class);

        return $this->request($context, $collection);
    }

    /**
     * @param $version
     *
     * @return AbstractResource|ChangeSetResource
     */
    public function getChangeSet($version)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/change-sets/%s', $version));

        return $this->request($context, new ChangeSetResource());
    }

    /**
     * @param ChangeSetResource $resource
     *
     * @return AbstractResource|ChangeSetResource
     */
    public function createChangeSet(ChangeSetResource $resource)
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/change-sets');
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, new ChangeSetResource());
    }
}
