<?php

namespace Brain\Cell\Client;

use Brain\Cell\Transfer\AbstractResource;

use Psr\Http\Message\StreamInterface;

abstract class DelegateClient
{

    /**
     * @var ClientConfiguration
     */
    protected $configuration;

    /**
     * {@inheritdoc}
     *
     * @param ClientConfiguration $configuration
     */
    public function __construct(ClientConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @param RequestContext $context
     * @param AbstractResource $entity
     * @return AbstractResource|array|bool
     */
    protected function request(RequestContext $context, $entity = null)
    {
        $response = $this->configuration->getRequestAdapter()->request($context);

        return $this->configuration->hasResourceHandler()
            ? $this->configuration->getResourceHandler()->deserialise($entity, $response)
            : $response;
    }

    /**
     * @param RequestContext $context
     * @return StreamInterface
     */
    protected function stream(RequestContext $context)
    {
        return $this->configuration->getRequestAdapter()->stream($context);
    }
}
