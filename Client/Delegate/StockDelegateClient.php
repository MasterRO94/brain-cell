<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\EntityResource\Stock\MaterialResource;
use Brain\Cell\EntityResource\StockFinishingsResource;
use Brain\Cell\Transfer\ResourceCollection;

class StockDelegateClient extends DelegateClient
{

    /**
     * @param JobResource $jobResource
     *
     * @return StockFinishingsResource
     */
    public function getFinishings(JobResource $jobResource)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/stock/finishings');

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($jobResource));

        return $this->request($context, new StockFinishingsResource);

    }

    /**
     * @return ResourceCollection|MaterialResource[]
     */
    public function getMaterials()
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/stock/materials');

        $collection = new ResourceCollection();
        $collection->setEntityClass(MaterialResource::class);

        return $this->request($context, $collection);

    }

}
