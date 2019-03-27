<?php

declare(strict_types=1);

namespace Brain\Cell\Exception\Request;

use Throwable;

/**
 * {@inheritdoc}
 */
class PayloadViolationException extends BadRequestException
{
    /** @var mixed[] */
    private $violations;

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

        $this->violations = $responsePayload['violations'] ?? [];
    }

    /**
     * Return the payload violations.
     *
     * @return mixed[]
     */
    public function getViolations(): array
    {
        return $this->violations;
    }
}
