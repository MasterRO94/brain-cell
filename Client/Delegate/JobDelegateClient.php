<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\Transfer\ResourceCollection;

class JobDelegateClient extends DelegateClient
{

    /**
     * @param array $filters
     *
     * @return ResourceCollection|JobResource[]
     */
    public function getFinishings(array $filters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/jobs');
        $context->getFilters()->add($filters);

        $collection = new ResourceCollection;
        $collection->setEntityClass(JobResource::class);

        return $this->request(
            $context,
            $collection
        );

    }

}
