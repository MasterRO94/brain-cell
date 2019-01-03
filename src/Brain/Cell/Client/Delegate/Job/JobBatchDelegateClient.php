<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Job;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Delivery\DeliveryOptionResource;
use Brain\Cell\EntityResource\Job\JobBatchBatchDeliveryResource;
use Brain\Cell\EntityResource\Job\JobBatchResource;
use Brain\Cell\Enum\JobBatchStatusEnum;
use Brain\Cell\Exception\ClientException;
use Brain\Cell\Logical\ArrayEncoderSerialisationOptions;

class JobBatchDelegateClient extends DelegateClient
{
    public function getJobBatch(string $id): JobBatchResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/jobs/batches/%s', $id));

        return $this->request($context, new JobBatchResource());
    }

    public function postJobBatch(JobBatchResource $resource): JobBatchResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/jobs/batches');

        $handler = $this->configuration->getResourceHandler();
        $payload = $handler->serialise($resource);
        $context->setPayload($payload);

        return $this->request($context, $resource);
    }

    public function updateJobBatchDeliveryOption(
        string $jobBatchId,
        DeliveryOptionResource $deliveryOptionResource
    ): JobBatchResource {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf('/jobs/batches/%s/delivery-option', $jobBatchId));

        $payload = [
            'delivery_option' => $deliveryOptionResource->getIdOrThrow(),
        ];

        $context->setPayload($payload);

        /** @var JobBatchResource $result */
        $result = $this->request($context, new JobBatchResource());

        return $result;
    }

    public function updateJobBatchBatchDelivery(
        string $jobBatchId,
        JobBatchBatchDeliveryResource $batchDeliveryResource
    ): JobBatchResource {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPatch(sprintf('/jobs/batches/%s/batch-delivery', $jobBatchId));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise(
            $batchDeliveryResource,
            new ArrayEncoderSerialisationOptions([
                'preferSerialisingResourceAliasOverId' => false,
            ])
        ));

        /** @var JobBatchResource $result */
        $result = $this->request($context, new JobBatchResource());

        return $result;
    }

    public function updateStatus(JobBatchResource $resource, string $status): JobBatchResource
    {
        if (!in_array($status, JobBatchStatusEnum::getAll())) {
            throw new ClientException(sprintf('Invalid status [%s]', $status));
        }

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf(
            '/jobs/batches/%s/%s',
            $resource->getId(),
            str_replace('_', '-', $status)
        ));

        return $this->request($context, $resource);
    }
}
