<?php
/**
 * @maintainer Alex Moon <alex.moon@printed.com>
 */

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\JobBatchResource;
use Brain\Cell\Enum\JobBatchStatusEnum;
use Brain\Cell\Exception\ClientException;

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
