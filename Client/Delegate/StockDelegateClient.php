<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Stock\MaterialResource;
use Brain\Cell\EntityResource\StockFinishingsResource;
use Brain\Cell\Transfer\ResourceCollection;

class StockDelegateClient extends DelegateClient
{

    /**
     * @param array $filters
     *
     * @return StockFinishingsResource
     */
    public function getFinishings(array $filters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/stock/finishings');
        $context->getFilters()->add($filters);

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
