<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Delivery\DeliveryOptionResource;
use Brain\Cell\EntityResource\Job\JobBatchResource;
use Brain\Cell\Transfer\ResourceCollection;

/**
 * {@inheritdoc}
 */
class DeliveryDelegateClient extends DelegateClient
{
    /**
     * @param JobBatchResource $batch
     *
     * @return ResourceCollection|DeliveryOptionResource[]
     */
    public function getDeliveryOptions(JobBatchResource $batch)
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
}
