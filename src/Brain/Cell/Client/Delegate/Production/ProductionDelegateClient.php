<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Production;

use Brain\Cell\Client\Delegate\Production\Status\ProductionStatusDelegateClient;
use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Production\ProductionResource;
use Brain\Cell\EntityResource\Production\ProductionResourceInterface;

/**
 * API client for operating on production's.
 */
/* final */class ProductionDelegateClient extends DelegateClient
{
    /**
     * Operate on production statuses.
     */
    public function status(): ProductionStatusDelegateClient
    {
        return new ProductionStatusDelegateClient($this->configuration);
    }

    /**
     * Create a production.
     */
    public function create(ProductionResourceInterface $production): ProductionResourceInterface
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/productions');

        $handler = $this->configuration->getResourceHandler();
        $payload = $handler->serialise($production);

        $context->setPayload($payload);

        /** @var ProductionResourceInterface $resource */
        $resource = $this->request($context, $production);

        return $resource;
    }

    /**
     * Return the production by id.
     */
    public function get(string $id): ProductionResourceInterface
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/productions/%s', $id));

        /** @var ProductionResource $resource */
        $resource = $this->request($context, new ProductionResource());

        return $resource;
    }
}
