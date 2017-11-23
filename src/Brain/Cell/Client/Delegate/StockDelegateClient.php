<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\EntityResource\Stock\FinishingCategoryResource;
use Brain\Cell\EntityResource\Stock\FinishingCombinationResource;
use Brain\Cell\EntityResource\Stock\FinishingItemResource;
use Brain\Cell\EntityResource\Stock\Material\MaterialBaseResource;
use Brain\Cell\EntityResource\Stock\Material\MaterialVariantResource;
use Brain\Cell\EntityResource\Stock\Material\MaterialWeightResource;
use Brain\Cell\EntityResource\Stock\MaterialResource;
use Brain\Cell\EntityResource\Stock\SizeResource;
use Brain\Cell\EntityResource\StockFinishingsResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

class StockDelegateClient extends DelegateClient
{
    /**
     * @param JobResource $jobResource
     *
     * @return AbstractResource|array|bool|StockFinishingsResource
     *
     * @deprecated Please use "getStockOptions" from now on.
     */
    public function getFinishings(JobResource $jobResource)
    {
        return $this->getStockOptions($jobResource);
    }

    /**
     * @param JobResource $jobResource
     *
     * @return StockFinishingsResource
     */
    public function getStockOptions(JobResource $jobResource)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/stock/options');

        $handler = $this->configuration->getResourceHandler();
        $payload = $handler->serialise($jobResource);
        $context->setPayload($payload);

        /** @var StockFinishingsResource $resource */
        $resource = $this->request($context, new StockFinishingsResource);

        return $resource;
    }

    /**
     * @return ResourceCollection|FinishingCategoryResource[]
     */
    public function getFinishingCategories(array $parameters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/stock/finishing/categories');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(FinishingCategoryResource::class);

        return $this->request($context, $collection);
    }

    /**
     * @param FinishingCategoryResource $resource
     * @return array|bool|AbstractResource|FinishingCategoryResource
     */
    public function createFinishingCategory(FinishingCategoryResource $resource)
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/stock/finishing/categories');
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, new FinishingCategoryResource());
    }

    /**
     * @param array $parameters
     * @return ResourceCollection|FinishingItemResource[]
     */
    public function getFinishingOptions(array $parameters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/stock/finishing/options');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(FinishingItemResource::class);

        return $this->request($context, $collection);
    }

    /**
     * @param FinishingCategoryResource $resource
     * @param array $parameters
     * @return array|bool|AbstractResource|FinishingItemResource[]
     */
    public function getFinishingCategoryOptions(FinishingCategoryResource $resource, array $parameters = [])
    {
        $categoryId = $resource->getId();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/stock/finishing/categories/%s/options', $categoryId));
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(FinishingItemResource::class);

        return $this->request($context, $collection);
    }

    /**
     * @param FinishingCategoryResource $categoryResource
     * @param FinishingItemResource $resource
     * @return array|bool|FinishingItemResource
     */
    public function createFinishingOption(FinishingCategoryResource $categoryResource, FinishingItemResource $resource)
    {
        $categoryId = $categoryResource->getId();

        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost(sprintf('/stock/finishing/categories/%s/options', $categoryId));
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, new FinishingItemResource());
    }

    /**
     * @param string $id
     *
     * @return MaterialResource[]|ResourceCollection
     */
    public function getMaterial($id)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/stock/materials/%s', $id));

        return $this->request($context, new MaterialResource());
    }

    /**
     * @return ResourceCollection|MaterialResource[]
     */
    public function getMaterials(array $parameters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/stock/materials');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(MaterialResource::class);

        return $this->request($context, $collection);

    }

    /**
     * @param array $parameters
     * @return ResourceCollection|MaterialBaseResource[]
     */
    public function getMaterialBases(array $parameters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/stock/materials/bases');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(MaterialBaseResource::class);

        return $this->request($context, $collection);
    }

    /**
     * @param array $parameters
     * @return ResourceCollection|MaterialVariantResource[]
     */
    public function getMaterialVariants(array $parameters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/stock/materials/variants');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(MaterialVariantResource::class);

        return $this->request($context, $collection);
    }

    /**
     * @param array $parameters
     * @return ResourceCollection|MaterialWeightResource[]
     */
    public function getMaterialWeights(array $parameters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/stock/materials/weights');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(MaterialWeightResource::class);

        return $this->request($context, $collection);
    }

    /**
     * @param MaterialBaseResource $resource
     * @return AbstractResource|array|bool|MaterialBaseResource
     */
    public function createMaterialBase(MaterialBaseResource $resource)
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/stock/materials/bases');
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, new MaterialBaseResource());
    }

    /**
     * @param MaterialWeightResource $resource
     * @return AbstractResource|array|bool|MaterialWeightResource
     */
    public function createMaterialWeight(MaterialWeightResource $resource)
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/stock/materials/weights');
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, new MaterialWeightResource());
    }

    /**
     * @param MaterialVariantResource $resource
     * @return AbstractResource|array|bool|MaterialVariantResource
     */
    public function createMaterialVariant(MaterialVariantResource $resource)
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/stock/materials/variants');
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, new MaterialVariantResource());
    }

    /**
     * @param MaterialResource $resource
     * @return array|bool|AbstractResource|MaterialResource
     */
    public function createMaterial(MaterialResource $resource)
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/stock/materials');
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, new MaterialResource());
    }

    /**
     * @param array $parameters
     * @return ResourceCollection|SizeResource[]
     */
    public function getSizes(array $parameters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/stock/sizes');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(SizeResource::class);

        return $this->request($context, $collection);
    }

    /**
     * @param SizeResource $resource
     * @return array|bool|AbstractResource|SizeResource
     */
    public function createSize(SizeResource $resource)
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/stock/sizes');
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, new SizeResource());
    }

    /**
     * @param FinishingCombinationResource $resource
     * @return AbstractResource|FinishingCategoryResource
     */
    public function createFinishingCombination(FinishingCombinationResource $resource)
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/stock/finishing-combinations');
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, new FinishingCombinationResource());
    }
}
