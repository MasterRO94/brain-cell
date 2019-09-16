<?php

namespace Brain\Cell\EntityResource;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;

interface ClientEnvironmentResourceInterface extends ResourceIdentityInterface
{
    /**
     * @return ClientEnvironmentTypeResourceInterface
     */
    public function getType(): ClientEnvironmentTypeResourceInterface;

    /**
     * @return string
     */
    public function getName(): string;
}
