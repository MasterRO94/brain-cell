<?php

namespace Brain\Cell\Client;

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

}
