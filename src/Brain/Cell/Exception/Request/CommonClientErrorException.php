<?php

declare(strict_types=1);

namespace Brain\Cell\Exception\Request;

use RuntimeException;
use Throwable;

/**
 * {@inheritdoc}
 */
class CommonClientErrorException extends BadRequestException
{
    /** @var mixed[] */
    private $responsePayload;

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
            $requestPayload,
            $responsePayload,
            $previous
        );

        if ($responsePayload === null) {
            throw new RuntimeException(sprintf('Cannot construct "%s" without response payload.', self::class));
        }

        $this->responsePayload = $responsePayload;
    }

    public function isMessageEndUserSafe(): bool
    {
        /*
         * Safe null coalesce is needed because Brain does not serialise falsy values.
         */
        return $this->responsePayload['data']['isMessageEndUserSafe'] ?? false;
    }

    public function getErrorCode(): ?string
    {
        return $this->responsePayload['data']['errorCode'] ?? null;
    }
}
