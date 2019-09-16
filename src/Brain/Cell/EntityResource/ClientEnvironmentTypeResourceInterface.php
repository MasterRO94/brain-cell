<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;

interface ClientEnvironmentTypeResourceInterface extends ResourceIdentityInterface
{
    public function getAlias(): string;

    public function getName(): string;

    public function getPriority(): int;
}
