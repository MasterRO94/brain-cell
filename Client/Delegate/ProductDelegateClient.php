<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Product\ProductResource;
use Brain\Cell\Transfer\ResourceCollection;

class ProductDelegateClient extends DelegateClient
{
    /**
     * @return ResourceCollection|ProductResource[]
     */
    public function getProducts()
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/products');

        $collection = new ResourceCollection;
        $collection->setEntityClass(ProductResource::class);

        return $this->request($context, $collection);
    }

    /**
     * @param string $id
     * @return ProductResource
     */
    public function getProduct($id)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/products/%s', $id));

        return $this->request($context, new ProductResource());
    }
}
