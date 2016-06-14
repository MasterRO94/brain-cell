<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Stock\OptionCategoryResource;
use Brain\Cell\Transfer\ResourceCollection;

class StockDelegateClient extends DelegateClient
{

    /**
     * @param array $filters
     *
     * @return ResourceCollection|OptionCategoryResource[]
     */
    public function getOptions(array $filters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/stock/options');
        $context->getFilters()->add($filters);

        $collection = new ResourceCollection;
        $collection->setEntityClass(OptionCategoryResource::class);

        return $this->request(
            $context,
            $collection
        );

    }

}
