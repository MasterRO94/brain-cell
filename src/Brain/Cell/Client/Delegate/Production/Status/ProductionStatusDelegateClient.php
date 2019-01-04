<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Production\Status;

use Brain\Cell\Client\Delegate\Production\Status\Helper\ProductionStatusTransitionHelper;
use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Common\AbstractStatusResource;
use Brain\Cell\EntityResource\Common\Status\StatusTransitionResource;
use Brain\Cell\EntityResource\Common\Status\StatusTransitionResourceInterface;
use Brain\Cell\EntityResource\Production\ProductionResourceInterface;
use Brain\Cell\EntityResource\Production\ProductionStatusResource;
use Brain\Cell\Transfer\ResourceCollection;

/**
 * API client for operating on production statuses.
 */
/* final */class ProductionStatusDelegateClient extends DelegateClient
{
    /**
     * Return the transition helper.
     */
    public function helper(): ProductionStatusTransitionHelper
    {
        return new ProductionStatusTransitionHelper($this);
    }

    /**
     * List all available transitions for the given production.
     *
     * @return ResourceCollection|StatusTransitionResourceInterface[]
     */
    public function available(ProductionResourceInterface $production): ResourceCollection
    {
        $id = $production->getId();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf('/productions/%s/status/transitions', $id));

        $collection = new ResourceCollection();
        $collection->setEntityClass(StatusTransitionResource::class);

        /** @var ResourceCollection $resource */
        $resource = $this->request($context, $collection);

        return $resource;
    }

    /**
     * Transition a production to the given status.
     */
    public function transition(
        ProductionResourceInterface $production,
        StatusTransitionResourceInterface $status
    ): AbstractStatusResource {
        $id = $production->getId();

        $handler = $this->configuration->getResourceHandler();
        $payload = $handler->serialise($status);

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf('/productions/%s/status', $id));
        $context->setPayload($payload);

        /** @var ProductionStatusResource $resource */
        $resource = $this->request($context, new ProductionStatusResource());

        return $resource;
    }
}
