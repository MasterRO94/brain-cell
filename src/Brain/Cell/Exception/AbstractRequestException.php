<?php

namespace Brain\Cell\Exception;

/**
 * An abstract request exception.
 */
abstract class AbstractRequestException extends \RuntimeException
{
    private $statusCode;
    private $requestPayload;
    private $responsePayload;

    /**
     * Constructor.
     *
     * @param string $message
     * @param int $statusCode
     * @param array|null $requestPayload
     * @param array|null $responsePayload
     * @param \Throwable $previous
     */
    public function __construct(
        string $message,
        int $statusCode,
        ?array $requestPayload,
        ?array $responsePayload,
        \Throwable $previous
    ) {
        parent::__construct($message, $statusCode, $previous);

        $this->statusCode = $statusCode;
        $this->requestPayload = $requestPayload;
        $this->responsePayload = $responsePayload;
    }

    /**
     * Return the status code.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Return the request payload.
     *
     * @return array|null
     */
    public function getRequestPayload(): ?array
    {
        return $this->requestPayload;
    }

    /**
     * Return the response payload.
     *
     * @return array|null
     */
    public function getResponsePayload(): ?array
    {
        return $this->responsePayload;
    }
}
