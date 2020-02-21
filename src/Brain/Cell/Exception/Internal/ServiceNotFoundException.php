<?php

declare(strict_types=1);

namespace Brain\Cell\Exception\Internal;

use Exception;
use Psr\Container\NotFoundExceptionInterface;

/**
 * @internal Part of CellServiceContainer
 */
class ServiceNotFoundException extends Exception implements NotFoundExceptionInterface
{
}
