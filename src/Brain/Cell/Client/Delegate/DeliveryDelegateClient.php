<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Country\CountryResource;
use Brain\Cell\EntityResource\Country\CountryResourceInterface;
use Brain\Cell\EntityResource\Delivery\DeliveryOptionResource;
use Brain\Cell\EntityResource\Delivery\DeliveryServiceResource;
use Brain\Cell\EntityResource\Delivery\DispatchResource;
use Brain\Cell\Transfer\ResourceCollection;

use GuzzleHttp\RequestOptions;
use Psr\Http\Message\StreamInterface;

/**
 * {@inheritdoc}
 */
class DeliveryDelegateClient extends DelegateClient
{
    /**
     * @return DeliveryOptionResource[]|ResourceCollection
     */
    public function getDeliveryOptions(
        DeliveryGetDeliveryOptionsActionArgs $actionArgs,
        array $options = []
    ): ResourceCollection {
        $options = array_merge([
            'requestTimeoutSeconds' => null,
        ], $options);

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost('/delivery/options');

        if (null !== $options['requestTimeoutSeconds']) {
            $context->getExtraGuzzleRequestOptions()->set(RequestOptions::TIMEOUT, $options['requestTimeoutSeconds']);
        }

        $handler = $this->configuration->getResourceHandler();
        $payload = $handler->serialise($actionArgs);
        $context->setPayload($payload);

        $collection = new ResourceCollection();
        $collection->setEntityClass(DeliveryOptionResource::class);

        /** @var ResourceCollection $resource */
        $resource = $this->request($context, $collection);

        return $resource;
    }

    public function getDeliveryOption(string $id): DeliveryOptionResource
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet(sprintf('/delivery/options/%s', $id));

        /** @var DeliveryOptionResource $resource */
        $resource = $this->request($context, new DeliveryOptionResource());

        return $resource;
    }

    /**
     * @return CountryResourceInterface[]|ResourceCollection
     */
    public function getCountries(): ResourceCollection
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet('/countries');
        $context->getParameters()->add(['limit' => 500]);

        $collection = new ResourceCollection();
        $collection->setEntityClass(CountryResource::class);

        /** @var ResourceCollection $resource */
        $resource = $this->request($context, $collection);

        return $resource;
    }

    /**
     * @param mixed[] $parameters
     *
     * @return DeliveryServiceResource[]|ResourceCollection
     */
    public function getServices(array $parameters = []): ResourceCollection
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet('/delivery/services');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(DeliveryServiceResource::class);

        /** @var ResourceCollection $resource */
        $resource = $this->request($context, $collection);

        return $resource;
    }

    public function createDispatch(DispatchResource $dispatch): DispatchResource
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost('/delivery/dispatch');

        $handler = $this->configuration->getResourceHandler();
        $payload = $handler->serialise($dispatch);
        $context->setPayload($payload);

        /** @var DispatchResource $resource */
        $resource = $this->request($context, new DispatchResource());

        return $resource;
    }

    public function downloadLabel(string $dispatchId): StreamInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet(sprintf('/delivery/dispatch/%s/label', $dispatchId));

        return $this->stream($context);
    }
}
