<?php

namespace Brain\Cell\Client;

use Brain\Cell\Transfer\AbstractResource;

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
     * @return AbstractResource|array
     */
    protected function request(RequestContext $context, $entity = null)
    {
        $response = $this->configuration->getRequestAdapter()->request($context);
        return $this->configuration->hasResourceHandler()
            ? $this->configuration->getResourceHandler()->deserialise($entity, $response)
            : $response;
    }

}
