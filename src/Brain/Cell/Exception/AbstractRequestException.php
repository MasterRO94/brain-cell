<?php

declare(strict_types=1);

namespace Brain\Cell\Exception;

use RuntimeException;
use Throwable;

/**
 * An abstract request exception.
 */
abstract class AbstractRequestException extends RuntimeException
{
    /** @var int */
    private $statusCode;

    /** @var mixed[]|null */
    private $requestPayload;

    /** @var mixed[]|null */
    private $responsePayload;

    /**
     * @param mixed[]|null $requestPayload
     * @param mixed[]|null $responsePayload
     */
    public function __construct(
        string $message,
        int $statusCode,
        ?array $requestPayload,
        ?array $responsePayload,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $statusCode, $previous);

        $this->statusCode = $statusCode;
        $this->requestPayload = $requestPayload;
        $this->responsePayload = $responsePayload;
    }

    /**
     * Return the status code.
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Return the request payload.
     *
     * @return mixed[]|null
     */
    public function getRequestPayload(): ?array
    {
        return $this->requestPayload;
    }

    /**
     * Return the response payload.
     *
     * @return mixed[]|null
     */
    public function getResponsePayload(): ?array
    {
        return $this->responsePayload;
    }
}
