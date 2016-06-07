<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\Client\RequestContext;
use Brain\Cell\EntityResource\Stock\OptionCategoryResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

class StockDelegateClient extends DelegateClient
{

    /**
     * @return ResourceCollection|OptionCategoryResource[]
     */
    public function getOptions()
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/stock/options');

        $collection = new ResourceCollection;
        $collection->setEntityClass(OptionCategoryResource::class);

        return $this->request(
            $context,
            $collection
        );

    }

    /**
     * @param RequestContext $context
     * @param AbstractResource $entity
     * @return AbstractResource|array
     */
    protected function request(RequestContext $context, $entity = null)
    {
        $response = $this->configuration->getRequestAdapter()->request($context);
        return $this->configuration->hasResourceHandler()
            ? $this->configuration->getResourceHandler()->deserialise($entity, $response)
            : $response;
    }

}
