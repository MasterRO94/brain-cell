<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource;

interface WebhookEndpointResourceInterface
{
    public function getEndpoint(): string;

    public function setEndpoint(string $endpoint): void;
}
