<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Common;

use DateTimeInterface;
use Exception;

interface DateResourceInterface
{
    /**
     * Return the ISO8601 date.
     */
    public function getIso(): string;

    /**
     * Set the ISO8601 date.
     */
    public function setIso(string $iso): void;

    /**
     * Return the timezone.
     */
    public function getTimezone(): string;

    /**
     * Set the timezone.
     */
    public function setTimezone(string $timezone): void;

    /**
     * Convert to a date time instance.
     *
     * @throws Exception Because DateTimeImmutable throws it for some reason.
     */
    public function asDateTime(): DateTimeInterface;
}
