<?php

declare(strict_types=1);

namespace Brain\Cell\Client;

use Brain\Cell\TransferEntityInterface;

use Psr\Http\Message\StreamInterface;

abstract class DelegateClient
{
    /** @var ClientConfiguration */
    protected $configuration;

    public function __construct(ClientConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    protected function request(RequestContext $context, ?TransferEntityInterface $resource = null): TransferEntityInterface
    {
        $response = $this->configuration->getRequestAdapter()->request($context);

        return $this->configuration->getResourceHandler()->deserialise($resource, $response);
    }

    protected function stream(RequestContext $context): StreamInterface
    {
        return $this->configuration->getRequestAdapter()->stream($context);
    }
}
