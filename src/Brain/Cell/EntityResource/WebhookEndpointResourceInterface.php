<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource;

use Brain\Cell\TransferEntityInterface;

interface WebhookEndpointResourceInterface extends TransferEntityInterface
{
    public function getEndpoint(): string;

    public function setEndpoint(string $endpoint): void;
}
