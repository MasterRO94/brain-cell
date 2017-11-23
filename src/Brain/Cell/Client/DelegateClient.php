<?php

namespace Brain\Cell\Client;

use Brain\Cell\TransferEntityInterface;

use Psr\Http\Message\StreamInterface;

abstract class DelegateClient
{
    /** @var ClientConfiguration */
    protected $configuration;

    /**
     * @param ClientConfiguration $configuration
     */
    public function __construct(ClientConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @param RequestContext $context
     * @param TransferEntityInterface $resource
     *
     * @return TransferEntityInterface
     */
    protected function request(RequestContext $context, TransferEntityInterface $resource = null)
    {
        $response = $this->configuration->getRequestAdapter()->request($context);

        return $this->configuration->getResourceHandler()->deserialise($resource, $response);
    }

    /**
     * @param RequestContext $context
     *
     * @return StreamInterface
     */
    protected function stream(RequestContext $context)
    {
        return $this->configuration->getRequestAdapter()->stream($context);
    }
}
