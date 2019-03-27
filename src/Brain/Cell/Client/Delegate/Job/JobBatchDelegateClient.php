<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Job;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Delivery\DeliveryOptionResource;
use Brain\Cell\EntityResource\Job\JobBatchBatchDeliveryResource;
use Brain\Cell\EntityResource\Job\JobBatchResource;
use Brain\Cell\EntityResource\Job\JobBatchResourceInterface;
use Brain\Cell\EntityResource\Job\JobStatusResource;
use Brain\Cell\Exception\ClientException;
use Brain\Cell\Logical\ArrayEncoderSerialisationOptions;

class JobBatchDelegateClient extends DelegateClient
{
    public function getJobBatch(string $id): JobBatchResourceInterface
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/jobs/batches/%s', $id));

        /** @var JobBatchResourceInterface $resource */
        $resource = $this->request($context, new JobBatchResource());

        return $resource;
    }

    public function postJobBatch(JobBatchResourceInterface $batch): JobBatchResourceInterface
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/jobs/batches');

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
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf('/jobs/batches/%s/delivery-option', $jobBatchId));

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
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPatch(sprintf('/jobs/batches/%s/batch-delivery', $jobBatchId));

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
        if (!in_array($status, JobStatusResource::getAllCanonicals())) {
            throw new ClientException(sprintf('Invalid status [%s]', $status));
        }

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf(
            '/jobs/batches/%s/%s',
            $batch->getId(),
            str_replace('_', '-', $status)
        ));

        /** @var JobBatchResourceInterface $resource */
        $resource = $this->request($context, $batch);

        return $resource;
    }
}
