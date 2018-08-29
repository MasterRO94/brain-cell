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
     * @param mixed[] $parameters
     * @param JobResource $jobResource
     *
     * @return StockFinishingsResource
     */
    public function getStockOptions(JobResource $jobResource, array $parameters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/stock/options');
        $context->getParameters()->replace($parameters);

        $handler = $this->configuration->getResourceHandler();
        $payload = $handler->serialise($jobResource);
        $context->setPayload($payload);

        /** @var StockFinishingsResource $resource */
        $resource = $this->request($context, new StockFinishingsResource());

        return $resource;
    }

    /**
     * @param mixed[] $parameters
     *
     * @return FinishingCategoryResource[]|ResourceCollection
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
     *
     * @return AbstractResource|array|bool|FinishingCategoryResource
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
     *
     * @return FinishingItemResource[]|ResourceCollection
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
     *
     * @return AbstractResource|array|bool|FinishingItemResource[]
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
     *
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
     * @param array $parameters
     *
     * @return MaterialResource[]|ResourceCollection
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
     *
     * @return MaterialBaseResource[]|ResourceCollection
     */
    public function getMaterialBases(array $parameters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/stock/material/bases');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(MaterialBaseResource::class);

        return $this->request($context, $collection);
    }

    /**
     * @param array $parameters
     *
     * @return MaterialVariantResource[]|ResourceCollection
     */
    public function getMaterialVariants(array $parameters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/stock/material/variants');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(MaterialVariantResource::class);

        return $this->request($context, $collection);
    }

    /**
     * @param array $parameters
     *
     * @return MaterialWeightResource[]|ResourceCollection
     */
    public function getMaterialWeights(array $parameters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/stock/material/weights');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(MaterialWeightResource::class);

        return $this->request($context, $collection);
    }

    /**
     * @param MaterialBaseResource $resource
     *
     * @return AbstractResource|array|bool|MaterialBaseResource
     */
    public function createMaterialBase(MaterialBaseResource $resource)
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/stock/material/bases');
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, new MaterialBaseResource());
    }

    /**
     * @param MaterialWeightResource $resource
     *
     * @return AbstractResource|array|bool|MaterialWeightResource
     */
    public function createMaterialWeight(MaterialWeightResource $resource)
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/stock/material/weights');
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, new MaterialWeightResource());
    }

    /**
     * @param MaterialVariantResource $resource
     *
     * @return AbstractResource|array|bool|MaterialVariantResource
     */
    public function createMaterialVariant(MaterialVariantResource $resource)
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/stock/material/variants');
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, new MaterialVariantResource());
    }

    /**
     * @param MaterialResource $resource
     *
     * @return AbstractResource|array|bool|MaterialResource
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
     *
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
     *
     * @return AbstractResource|array|bool|SizeResource
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
     *
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
