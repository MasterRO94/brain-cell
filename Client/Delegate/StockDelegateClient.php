<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Stock\FinishingCategoryResource;
use Brain\Cell\Transfer\ResourceCollection;

class StockDelegateClient extends DelegateClient
{

    /**
     * @param array $filters
     *
     * @return ResourceCollection|FinishingCategoryResource[]
     */
    public function getFinishings(array $filters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/stock/finishings');
        $context->getFilters()->add($filters);

        $collection = new ResourceCollection;
        $collection->setEntityClass(FinishingCategoryResource::class);

        return $this->request(
            $context,
            $collection
        );

    }

}
