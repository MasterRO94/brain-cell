<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Product\ProductResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

class ProductDelegateClient extends DelegateClient
{
    /**
     * @param array $parameters
     * @return ProductResource[]|ResourceCollection
     */
    public function getProducts(array $parameters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/products');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection;
        $collection->setEntityClass(ProductResource::class);

        return $this->request($context, $collection);
    }

    /**
     * @param string $id
     * @return AbstractResource|ProductResource
     */
    public function getProduct($id)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/products/%s', $id));

        return $this->request($context, new ProductResource());
    }

    /**
     * @param ProductResource $resource
     * @return AbstractResource|ProductResource
     */
    public function createProduct(ProductResource $resource)
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/products');
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, new ProductResource());
    }
}
