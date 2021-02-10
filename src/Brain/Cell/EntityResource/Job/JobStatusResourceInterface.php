<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Common\DateResourceInterface;

interface JobStatusResourceInterface
{
    /**
     * @return string[]
     */
    public static function getAllCanonicals(): array;

    /**
     * @return string[]
     */
    public function getAssociatedResources(): array;

    public function getCreatedAt(): DateResourceInterface;

    public function setCreatedAt(DateResourceInterface $createdAt): void;

    public function getCanonical(): string;

    public function getMessage(): string;
}
