<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Delivery\DeliveryOptionResource;
use Brain\Cell\EntityResource\Delivery\DeliveryJobBatchResource;
use Brain\Cell\EntityResource\Delivery\DispatchResource;
use Brain\Cell\Transfer\ResourceCollection;

/**
 * {@inheritdoc}
 */
class DeliveryDelegateClient extends DelegateClient
{
    /**
     * @param DeliveryJobBatchResource $batch
     *
     * @return ResourceCollection|DeliveryOptionResource[]
     */
    public function getDeliveryOptions(DeliveryJobBatchResource $batch)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/delivery/options');

        $handler = $this->configuration->getResourceHandler();
        $payload = $handler->serialise($batch);
        $context->setPayload($payload);

        $collection = new ResourceCollection();
        $collection->setEntityClass(DeliveryOptionResource::class);

        return $this->request($context, $collection);
    }

    /**
     * @param string $id
     *
     * @return DeliveryOptionResource
     */
    public function getDeliveryOption($id)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/delivery/options/%s', $id));

        /** @var DeliveryOptionResource $resource */
        $resource = $this->request($context, new DeliveryOptionResource());

        return $resource;
    }

    /**
     * @param DispatchResource $dispatch
     *
     * @return DispatchResource
     */
    public function createDispatch($dispatch)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/delivery/dispatch');

        $handler = $this->configuration->getResourceHandler();
        $payload = $handler->serialise($dispatch);
        $context->setPayload($payload);

        /** @var DispatchResource $resource */
        $resource = $this->request($context, new DispatchResource());

        return $resource;
    }
}
