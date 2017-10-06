<?php
/**
 * @maintainer Alex Moon <alex.moon@printed.com>
 */

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Delivery\DeliveryOptionResource;
use Brain\Cell\EntityResource\Job\JobBatchBatchDeliveryResource;
use Brain\Cell\EntityResource\Job\JobBatchResource;
use Brain\Cell\Enum\JobBatchStatusEnum;
use Brain\Cell\Exception\ClientException;
use Brain\Cell\Logical\ArrayEncoderSerialisationOptions;

class JobBatchDelegateClient extends DelegateClient
{

    /**
     * @param string $id
     *
     * @return JobBatchResource
     */
    public function getJobBatch($id)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/jobs/batches/%s', $id));

        return $this->request($context, new JobBatchResource);
    }

    /**
     * @param JobBatchResource $resource
     *
     * @return JobBatchResource
     */
    public function postJobBatch(JobBatchResource $resource)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/jobs/batches');

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, $resource);
    }

    /**
     * @param string $jobBatchId
     * @param DeliveryOptionResource $deliveryOptionResource
     *
     * @return JobBatchResource
     */
    public function updateJobBatchDeliveryOption(
        $jobBatchId,
        DeliveryOptionResource $deliveryOptionResource
    ) {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut("/jobs/batches/{$jobBatchId}/delivery-option");

        $payload = [
            'delivery_option' => $deliveryOptionResource->getIdOrThrow(),
        ];

        $context->setPayload($payload);

        /** @var JobBatchResource $result */
        $result = $this->requestAndDeserialise($context, new JobBatchResource());

        return $result;
    }

    /**
     * @param string $jobBatchId
     * @param JobBatchBatchDeliveryResource $batchDeliveryResource
     *
     * @return JobBatchResource
     */
    public function updateJobBatchBatchDelivery(
        $jobBatchId,
        JobBatchBatchDeliveryResource $batchDeliveryResource
    ) {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPatch("/jobs/batches/{$jobBatchId}/batch-delivery");

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise(
            $batchDeliveryResource,
            new ArrayEncoderSerialisationOptions([
                'preferSerialisingResourceAliasOverId' => false,
            ])
        ));

        /** @var JobBatchResource $result */
        $result = $this->requestAndDeserialise($context, new JobBatchResource());

        return $result;
    }

    /**
     * @param JobBatchResource $resource
     * @param string $status
     * @return JobBatchResource
     */
    public function updateStatus(JobBatchResource $resource, $status)
    {
        if (! in_array($status, JobBatchStatusEnum::getAll())) {
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
