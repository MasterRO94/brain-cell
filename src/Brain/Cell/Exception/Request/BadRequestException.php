<?php

namespace Brain\Cell\Exception\Request;

use Brain\Cell\Exception\AbstractRequestException;

/**
 * {@inheritdoc}
 */
class BadRequestException extends AbstractRequestException
{
    /**
     * Constructor.
     *
     * @param string $message
     * @param array|null $requestPayload
     * @param array|null $responsePayload
     * @param \Throwable $previous
     */
    public function __construct(
        string $message,
        ?array $requestPayload,
        ?array $responsePayload,
        \Throwable $previous
    ) {
        parent::__construct(
            $message,
            400,
            $requestPayload,
            $responsePayload,
            $previous
        );
    }
}
