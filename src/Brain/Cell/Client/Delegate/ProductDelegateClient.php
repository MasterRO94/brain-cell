<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Product\ProductFinishingAssignmentResource;
use Brain\Cell\EntityResource\Product\ProductMaterialAssignmentResource;
use Brain\Cell\EntityResource\Product\ProductResource;
use Brain\Cell\EntityResource\Product\ProductSizeAssignmentResource;
use Brain\Cell\EntityResource\Stock\Finishing\FinishingItemResource;
use Brain\Cell\EntityResource\Stock\MaterialResource;
use Brain\Cell\EntityResource\Stock\SizeResource;
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
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
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
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet(sprintf('/products/%s', $id));

        /** @var ProductResource $resource */
        $resource = $this->request($context, new ProductResource());

        return $resource;
    }

    public function createProduct(ProductResource $resource): ProductResource
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
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

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
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

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
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

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost(sprintf('/products/%s/finishings', $productResource->getId()));
        $context->setPayload($handler->serialise($assignmentResource));

        /** @var ProductFinishingAssignmentResource $resource */
        $resource = $this->request($context, new ProductFinishingAssignmentResource());

        return $resource;
    }

    public function linkMaterial(ProductResource $productResource, MaterialResource $materialResource): void
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForLink(sprintf('/products/%s/materials/%s', $productResource->getId(), $materialResource->getId()));

        $this->configuration->getRequestAdapter()->request($context);
    }

    public function linkSize(ProductResource $productResource, SizeResource $sizeResource): void
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForLink(sprintf('/products/%s/sizes/%s', $productResource->getId(), $sizeResource->getId()));

        $this->configuration->getRequestAdapter()->request($context);
    }

    public function linkFinishing(ProductResource $productResource, FinishingItemResource $finishingItemResource): void
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForLink(sprintf('/products/%s/finishings/%s', $productResource->getId(), $finishingItemResource->getId()));

        $this->configuration->getRequestAdapter()->request($context);
    }
}
