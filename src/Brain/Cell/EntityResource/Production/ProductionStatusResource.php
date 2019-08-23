<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Production;

use Brain\Cell\EntityResource\Common\AbstractStatusResource;

/**
 * A production status.
 */
final class ProductionStatusResource extends AbstractStatusResource
{
    public const STATUS_STARTED = 'started';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';
}
