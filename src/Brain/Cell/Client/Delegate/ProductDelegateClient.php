<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Product\ProductFinishingAssignmentResource;
use Brain\Cell\EntityResource\Product\ProductMaterialAssignmentResource;
use Brain\Cell\EntityResource\Product\ProductResource;
use Brain\Cell\EntityResource\Product\ProductSizeAssignmentResource;
use Brain\Cell\Transfer\ResourceCollection;

class ProductDelegateClient extends DelegateClient
{
    /**
     * @param mixed[] $parameters
     *
     * @return ProductResource[]|ResourceCollection
     */
    public function getProducts(array $parameters = []): ResourceCollection
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/products');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(ProductResource::class);

        /** @var ResourceCollection $resource */
        $resource = $this->request($context, $collection);

        return $resource;
    }

    public function getProduct(string $id): ProductResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/products/%s', $id));

        /** @var ProductResource $resource */
        $resource = $this->request($context, new ProductResource());

        return $resource;
    }

    public function createProduct(ProductResource $resource): ProductResource
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/products');
        $context->setPayload($handler->serialise($resource));

        /** @var ProductResource $resource */
        $resource = $this->request($context, new ProductResource());

        return $resource;
    }

    public function createProductSizeAssignment(
        ProductResource $productResource,
        ProductSizeAssignmentResource $assignmentResource
    ): ProductSizeAssignmentResource {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost(sprintf('/products/%s/sizes', $productResource->getId()));
        $context->setPayload($handler->serialise($assignmentResource));

        /** @var ProductSizeAssignmentResource $resource */
        $resource = $this->request($context, new ProductSizeAssignmentResource());

        return $resource;
    }

    public function createProductMaterialAssignment(
        ProductResource $productResource,
        ProductMaterialAssignmentResource $assignmentResource
    ): ProductMaterialAssignmentResource {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost(sprintf('/products/%s/materials', $productResource->getId()));
        $context->setPayload($handler->serialise($assignmentResource));

        /** @var ProductMaterialAssignmentResource $resource */
        $resource = $this->request($context, new ProductMaterialAssignmentResource());

        return $resource;
    }

    public function createProductFinishingAssignment(
        ProductResource $productResource,
        ProductFinishingAssignmentResource $assignmentResource
    ): ProductFinishingAssignmentResource {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost(sprintf('/products/%s/finishings', $productResource->getId()));
        $context->setPayload($handler->serialise($assignmentResource));

        /** @var ProductFinishingAssignmentResource $resource */
        $resource = $this->request($context, new ProductFinishingAssignmentResource());

        return $resource;
    }
}
