<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\CountryResource;
use Brain\Cell\EntityResource\Delivery\DeliveryJobBatchResource;
use Brain\Cell\EntityResource\Delivery\DeliveryOptionResource;
use Brain\Cell\EntityResource\Delivery\DeliveryServiceResource;
use Brain\Cell\EntityResource\Delivery\DispatchResource;
use Brain\Cell\Transfer\ResourceCollection;

use Psr\Http\Message\StreamInterface;

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
     * @return CountryResource[]
     */
    public function getCountries()
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/countries');

        $collection = new ResourceCollection();
        $collection->setEntityClass(CountryResource::class);
        $resource = $this->request($context, $collection);

        return $resource;
    }

    /**
     * @param array $parameters
     * @return DeliveryServiceResource[]
     */
    public function getServices($parameters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/delivery/services');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(DeliveryServiceResource::class);
        $resource = $this->request($context, $collection);

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

    /**
     * @param string $dispatchId
     *
     * @return StreamInterface
     */
    public function downloadLabel($dispatchId)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/delivery/dispatch/%s/label', $dispatchId));
        return $this->stream($context);
    }
}
