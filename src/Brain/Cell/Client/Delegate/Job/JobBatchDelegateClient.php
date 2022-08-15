<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Job;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Delivery\DeliveryOptionResource;
use Brain\Cell\EntityResource\Job\JobBatchBatchDeliveryResource;
use Brain\Cell\EntityResource\Job\JobBatchResource;
use Brain\Cell\EntityResource\Job\JobBatchResourceInterface;
use Brain\Cell\EntityResource\Job\JobBatchStatusResource;
use Brain\Cell\EntityResource\Job\ValueObjectResource\UpdateJobBatchBatchDeliveryActionOptions;
use Brain\Cell\Exception\ClientException;
use Brain\Cell\Logical\ArrayEncoderSerialisationOptions;
use Brain\Cell\Transfer\ResourceCollection;

class JobBatchDelegateClient extends DelegateClient
{
    private const GET_PATH = '/job/batches/%s';

    public function getJobBatch(string $id): JobBatchResourceInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet(sprintf(self::GET_PATH, $id));

        /** @var JobBatchResourceInterface $resource */
        $resource = $this->request($context, new JobBatchResource());

        return $resource;
    }

    public function postJobBatch(JobBatchResourceInterface $batch): JobBatchResourceInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost('/job/batches');

        $payload = $this->resourceHandler->serialise($batch);
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
        JobBatchBatchDeliveryResource $batchDeliveryResource,
        ?UpdateJobBatchBatchDeliveryActionOptions $actionOptions = null
    ): JobBatchResourceInterface {
        if ($actionOptions === null) {
            $actionOptions = new UpdateJobBatchBatchDeliveryActionOptions();
        }

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPatch(sprintf('/job/batches/%s/batch-delivery', $jobBatchId));

        $payload = array_merge(
            $this->resourceHandler->serialise(
                $batchDeliveryResource,
                new ArrayEncoderSerialisationOptions([
                    'preferSerialisingResourceAliasOverId' => false,
                ])
            ),
            [
                '__action_options' => $this->resourceHandler->serialise($actionOptions),
            ]
        );

        $context->setPayload($payload);

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

        /** @var ResourceCollection $collection */
        $collection = $this->request($context, $collection);

        return $collection;
    }

    /**
     * Async return a job batch by id.
     *
     * @param string[] $ids
     *
     * @return JobBatchResource[]
     */
    public function getAsync(array $ids): array
    {
        $contexts = [];

        foreach ($ids as $key => $id) {
            $context = $this->configuration->createRequestContext(self::VERSION_V1);
            $context->prepareContextForGet(sprintf(self::GET_PATH, $id));

            $contexts[$key] = $context;
        }

        return $this->requestAsync($contexts, JobBatchResource::class);
    }
}
