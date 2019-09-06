<?php

namespace Brain\Cell\Client;

class SingleClientConfiguration extends ClientConfiguration
{
    public function __construct(RequestAdapterInterface $requestAdapter, string $apiKey)
    {
        parent::__construct($requestAdapter);
        $this->apiKey = $apiKey;
    }
}
