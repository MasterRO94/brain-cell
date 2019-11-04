<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Job;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Delivery\DeliveryOptionResource;
use Brain\Cell\EntityResource\Job\JobBatchBatchDeliveryResource;
use Brain\Cell\EntityResource\Job\JobBatchResource;
use Brain\Cell\EntityResource\Job\JobBatchResourceInterface;
use Brain\Cell\EntityResource\Job\JobBatchStatusResource;
use Brain\Cell\Exception\ClientException;
use Brain\Cell\Logical\ArrayEncoderSerialisationOptions;

class JobBatchDelegateClient extends DelegateClient
{
    public function getJobBatch(string $id): JobBatchResourceInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet(sprintf('/job/batches/%s', $id));

        /** @var JobBatchResourceInterface $resource */
        $resource = $this->request($context, new JobBatchResource());

        return $resource;
    }

    public function postJobBatch(JobBatchResourceInterface $batch): JobBatchResourceInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost('/job/batches');

        $handler = $this->configuration->getResourceHandler();
        $payload = $handler->serialise($batch);
        $context->setPayload($payload);

        /** @var JobBatchResourceInterface $resource */
        $resource = $this->request($context, $batch);

        return $resource;
    }

    public function updateJobBatchDeliveryOption(
        string $jobBatchId,
        DeliveryOptionResource $deliveryOptionResource
    ): JobBatchResourceInterface {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPut(sprintf('/job/batches/%s/delivery-option', $jobBatchId));

        $payload = [
            'delivery_option' => $deliveryOptionResource->getId(),
        ];

        $context->setPayload($payload);

        /** @var JobBatchResourceInterface $resource */
        $resource = $this->request($context, new JobBatchResource());

        return $resource;
    }

    public function updateJobBatchBatchDelivery(
        string $jobBatchId,
        JobBatchBatchDeliveryResource $batchDeliveryResource
    ): JobBatchResourceInterface {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPatch(sprintf('/job/batches/%s/batch-delivery', $jobBatchId));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise(
            $batchDeliveryResource,
            new ArrayEncoderSerialisationOptions([
                'preferSerialisingResourceAliasOverId' => false,
            ])
        ));

        /** @var JobBatchResourceInterface $resource */
        $resource = $this->request($context, new JobBatchResource());

        return $resource;
    }

    public function updateStatus(JobBatchResourceInterface $batch, string $status): JobBatchResourceInterface
    {
        if (!in_array($status, JobBatchStatusResource::getAllCanonicals(), true)) {
            throw new ClientException(sprintf('Invalid status [%s]', $status));
        }

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPut(sprintf(
            '/job/batches/%s/status',
            $batch->getId()
        ));

        $payload = ['status' => $status];
        $context->setPayload($payload);

        /** @var JobBatchResourceInterface $resource */
        $resource = $this->request($context, $batch);

        return $resource;
    }

    /**
     * @return ResourceCollection|JobBatchStatusResource[]
     */
    public function getAvailableTransitions(string $id): ResourceCollection
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet(sprintf('/job/batches/%s/status/transitions', $id));

        $collection = new ResourceCollection();
        $collection->setEntityClass(JobBatchStatusResource::class);

        $collection = $this->request($context, $collection);

        return $collection;
    }
}
