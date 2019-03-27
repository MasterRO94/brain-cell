<?php

declare(strict_types=1);

namespace Brain\Cell\Exception\Request;

use Brain\Cell\Exception\AbstractRequestException;

use Throwable;

/**
 * {@inheritdoc}
 */
class NotFoundException extends AbstractRequestException
{
    /**
     * @param mixed[]|null $requestPayload
     * @param mixed[]|null $responsePayload
     */
    public function __construct(
        string $message,
        ?array $requestPayload,
        ?array $responsePayload,
        ?Throwable $previous = null
    ) {
        parent::__construct(
            $message,
            404,
            $requestPayload,
            $responsePayload,
            $previous
        );
    }
}
