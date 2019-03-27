<?php

declare(strict_types=1);

namespace Brain\Cell\Response;

final class ErrorMessageEnum
{
    public const ERROR_PAYLOAD_VIOLATION = 'api.request.error.payload';
    public const ERROR_STATUS_TRANSITION = 'api.status.transition.bad_request';
}
