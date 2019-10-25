<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Common\Weight\WeightResource;
use Brain\Cell\EntityResource\Common\Weight\WeightResourceInterface;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\EntityResource\Stock\Finishing\FinishingCategoryResource;
use Brain\Cell\EntityResource\Stock\Finishing\FinishingCategoryResourceInterface;
use Brain\Cell\EntityResource\Stock\Finishing\FinishingItemResource;
use Brain\Cell\EntityResource\Stock\FinishingCombinationResource;
use Brain\Cell\EntityResource\Stock\Material\MaterialBaseResource;
use Brain\Cell\EntityResource\Stock\Material\MaterialVariantResource;
use Brain\Cell\EntityResource\Stock\Material\MaterialWeightResource;
use Brain\Cell\EntityResource\Stock\MaterialResource;
use Brain\Cell\EntityResource\Stock\MaterialResourceInterface;
use Brain\Cell\EntityResource\Stock\SizeResource;
use Brain\Cell\EntityResource\StockFinishingsResource;
use Brain\Cell\Transfer\ResourceCollection;

class StockDelegateClient extends DelegateClient
{
    /**
     * @deprecated Please use "getStockOptions" from now on.
     */
    public function getFinishings(JobResource $jobResource): StockFinishingsResource
    {
        return $this->getStockOptions($jobResource);
    }

    /**
     * @param mixed[] $parameters
     */
    public function getStockOptions(JobResource $jobResource, array $parameters = []): StockFinishingsResource
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
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
    public function getFinishingCategories(array $parameters = []): ResourceCollection
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet('/stock/finishing/categories');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(FinishingCategoryResource::class);

        /** @var ResourceCollection $resource */
        $resource = $this->request($context, $collection);

        return $resource;
    }

    public function createFinishingCategory(FinishingCategoryResource $resource): FinishingCategoryResourceInterface
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost('/stock/finishing/categories');
        $context->setPayload($handler->serialise($resource));

        /** @var FinishingCategoryResourceInterface $resource */
        $resource = $this->request($context, new FinishingCategoryResource());

        return $resource;
    }

    /**
     * @param mixed[] $parameters
     *
     * @return FinishingItemResource[]|ResourceCollection
     */
    public function getFinishingOptions(array $parameters = []): ResourceCollection
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet('/stock/finishing/options');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(FinishingItemResource::class);

        /** @var ResourceCollection $resource */
        $resource = $this->request($context, $collection);

        return $resource;
    }

    /**
     * @param mixed[] $parameters
     *
     * @return ResourceCollection|FinishingItemResource[]
     */
    public function getFinishingCategoryOptions(FinishingCategoryResource $resource, array $parameters = []): ResourceCollection
    {
        $categoryId = $resource->getId();

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet(sprintf('/stock/finishing/categories/%s/options', $categoryId));
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(FinishingItemResource::class);

        /** @var ResourceCollection $resource */
        $resource = $this->request($context, $collection);

        return $resource;
    }

    public function createFinishingOption(FinishingCategoryResource $categoryResource, FinishingItemResource $resource): FinishingItemResource
    {
        $categoryId = $categoryResource->getId();

        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost(sprintf('/stock/finishing/categories/%s/options', $categoryId));
        $context->setPayload($handler->serialise($resource));

        /** @var FinishingItemResource $resource */
        $resource = $this->request($context, new FinishingItemResource());

        return $resource;
    }

    public function getMaterial(string $id): MaterialResourceInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet(sprintf('/stock/materials/%s', $id));

        /** @var MaterialResourceInterface $resource */
        $resource = $this->request($context, new MaterialResource());

        return $resource;
    }

    /**
     * @param mixed[] $parameters
     *
     * @return MaterialResourceInterface[]|ResourceCollection
     */
    public function getMaterials(array $parameters = []): ResourceCollection
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet('/stock/materials');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(MaterialResource::class);

        /** @var ResourceCollection $resource */
        $resource = $this->request($context, $collection);

        return $resource;
    }

    /**
     * @param mixed[] $parameters
     *
     * @return MaterialBaseResource[]|ResourceCollection
     */
    public function getMaterialBases(array $parameters = []): ResourceCollection
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet('/stock/material/bases');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(MaterialBaseResource::class);

        /** @var ResourceCollection $resource */
        $resource = $this->request($context, $collection);

        return $resource;
    }

    /**
     * @param mixed[] $parameters
     *
     * @return MaterialVariantResource[]|ResourceCollection
     */
    public function getMaterialVariants(array $parameters = []): ResourceCollection
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet('/stock/material/variants');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(MaterialVariantResource::class);

        /** @var ResourceCollection $resource */
        $resource = $this->request($context, $collection);

        return $resource;
    }

    /**
     * @param mixed[] $parameters
     *
     * @return MaterialWeightResource[]|ResourceCollection
     */
    public function getMaterialWeights(array $parameters = []): ResourceCollection
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet('/stock/material/weights');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(MaterialWeightResource::class);

        /** @var ResourceCollection $resource */
        $resource = $this->request($context, $collection);

        return $resource;
    }

    public function createMaterialBase(MaterialBaseResource $resource): MaterialBaseResource
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost('/stock/material/bases');
        $context->setPayload($handler->serialise($resource));

        /** @var MaterialBaseResource $resource */
        $resource = $this->request($context, new MaterialBaseResource());

        return $resource;
    }

    public function createMaterialWeight(MaterialWeightResource $resource): MaterialWeightResource
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost('/stock/material/weights');
        $context->setPayload($handler->serialise($resource));

        /** @var MaterialWeightResource $resource */
        $resource = $this->request($context, new MaterialWeightResource());

        return $resource;
    }

    public function createMaterialVariant(MaterialVariantResource $resource): MaterialVariantResource
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost('/stock/material/variants');
        $context->setPayload($handler->serialise($resource));

        /** @var MaterialVariantResource $resource */
        $resource = $this->request($context, new MaterialVariantResource());

        return $resource;
    }

    public function createMaterial(MaterialResource $resource): MaterialResource
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost('/stock/materials');
        $context->setPayload($handler->serialise($resource));

        /** @var MaterialResource $resource */
        $resource = $this->request($context, new MaterialResource());

        return $resource;
    }

    /**
     * @param mixed[] $parameters
     *
     * @return ResourceCollection|SizeResource[]
     */
    public function getSizes(array $parameters = []): ResourceCollection
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet('/stock/sizes');
        $context->getParameters()->add($parameters);

        $collection = new ResourceCollection();
        $collection->setEntityClass(SizeResource::class);

        /** @var ResourceCollection $resource */
        $resource = $this->request($context, $collection);

        return $resource;
    }

    public function createSize(SizeResource $resource): SizeResource
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost('/stock/sizes');
        $context->setPayload($handler->serialise($resource));

        /** @var SizeResource $resource */
        $resource = $this->request($context, new SizeResource());

        return $resource;
    }

    public function createFinishingCombination(FinishingCombinationResource $resource): FinishingCategoryResource
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost('/stock/finishing-combinations');
        $context->setPayload($handler->serialise($resource));

        /** @var FinishingCategoryResource $resource */
        $resource = $this->request($context, new FinishingCombinationResource());

        return $resource;
    }

    /**
     * Calculate the weight of the given job.
     */
    public function calculateJobWeight(JobResource $resource): WeightResourceInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost('/stock/weight');

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($resource));

        /** @var WeightResource $resource */
        $resource = $this->request($context, new WeightResource());

        return $resource;
    }
}
