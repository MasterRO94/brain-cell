<?php

namespace Brain\Cell\EntityResource;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;

interface ClientEnvironmentTypeResourceInterface extends ResourceIdentityInterface
{
    /**
     * @return string
     */
    public function getAlias(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return int
     */
    public function getPriority(): int;
}
