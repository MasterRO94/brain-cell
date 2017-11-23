<?php

namespace Brain\Cell\Exception\Request;

/**
 * {@inheritdoc}
 */
class PayloadViolationException extends BadRequestException
{
    /** @var array */
    private $violations;

    /**
     * Constructor.
     *
     * @param string $message
     * @param array|null $requestPayload
     * @param array|null $responsePayload
     * @param \Throwable|null $previous
     */
    public function __construct(
        string $message,
        ?array $requestPayload,
        ?array $responsePayload,
        ?\Throwable $previous = null
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
     * @return array
     */
    public function getViolations(): array
    {
        return $this->violations;
    }
}
