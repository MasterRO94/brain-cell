<?php

namespace Brain\Cell\EntityResource;

interface WebhookEndpointResourceInterface
{
    /**
     * @return string
     */
    public function getEndpoint(): string;

    /**
     * @param string $endpoint
     */
    public function setEndpoint(string $endpoint): void;
}
