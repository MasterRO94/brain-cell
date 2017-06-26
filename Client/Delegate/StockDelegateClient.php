<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\EntityResource\Stock\FinishingCategoryResource;
use Brain\Cell\EntityResource\Stock\FinishingItemResource;
use Brain\Cell\EntityResource\Stock\Material\MaterialBaseResource;
use Brain\Cell\EntityResource\Stock\Material\MaterialVariantResource;
use Brain\Cell\EntityResource\Stock\Material\MaterialWeightResource;
use Brain\Cell\EntityResource\Stock\MaterialResource;
use Brain\Cell\EntityResource\StockFinishingsResource;
use Brain\Cell\Transfer\ResourceCollection;

class StockDelegateClient extends DelegateClient
{

    /**
     * @param JobResource $jobResource
     *
     * @return StockFinishingsResource
     */
    public function getFinishings(JobResource $jobResource)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/stock/finishings');

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($jobResource));

        return $this->request($context, new StockFinishingsResource);

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

    public function createFinishingCategory(FinishingCategoryResource $resource)
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/stock/finishing/categories');
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, new FinishingCategoryResource());
    }

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

    public function getMaterialVariants(array $parameters = [])
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/stock/materials/variants');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(MaterialVariantResource::class);

        return $this->request($context, $collection);
    }

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
     * @return MaterialBaseResource
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
     * @return MaterialWeightResource
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
     * @return MaterialVariantResource
     */
    public function createMaterialVariant(MaterialVariantResource $resource)
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/stock/materials/variants');
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, new MaterialVariantResource());
    }

    public function createMaterial(MaterialResource $resource)
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/stock/materials');
        $context->setPayload($handler->serialise($resource));

        return $this->request($context, new MaterialResource());
    }

}
