<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;

interface ClientEnvironmentResourceInterface extends ResourceIdentityInterface
{
    public function getType(): ClientEnvironmentTypeResourceInterface;

    public function getName(): string;
}
