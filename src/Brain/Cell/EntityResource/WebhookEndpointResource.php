<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource;

use Brain\Cell\Transfer\AbstractResource;

final class WebhookEndpointResource extends AbstractResource implements
    WebhookEndpointResourceInterface
{
    /** @var string */
    protected $endpoint;

    /**
     * {@inheritdoc}
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * {@inheritdoc}
     */
    public function setEndpoint(string $endpoint): void
    {
        $this->endpoint = $endpoint;
    }
}
