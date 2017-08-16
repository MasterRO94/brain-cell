<?php
/**
 * @maintainer Alex Moon <alex.moon@printed.com>
 */

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\JobBatchResource;

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
}
