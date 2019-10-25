<?php

declare(strict_types=1);

namespace Brain\Cell\Client;

use Brain\Cell\TransferEntityInterface;

use Psr\Http\Message\StreamInterface;

abstract class DelegateClient
{
    protected const VERSION_V1 = 'v1';
    protected const VERSION_10 = '1.0';
    protected const VERSION_20 = '2.0';

    /** @var ClientConfiguration */
    protected $configuration;

    public function __construct(ClientConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    final protected function request(
        RequestContext $context,
        TransferEntityInterface $resource
    ): TransferEntityInterface {
        $response = $this->configuration->getRequestAdapter()->request($context);

        return $this->configuration->getResourceHandler()->deserialise($resource, $response);
    }

    protected function stream(RequestContext $context): StreamInterface
    {
        return $this->configuration->getRequestAdapter()->stream($context);
    }
}
