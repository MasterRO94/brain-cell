<?php

namespace Brain\Cell\EntityResource\Common;

use Brain\Cell\Transfer\AbstractResource;

use DateTimeImmutable;
use DateTimeInterface;
use Exception;

final class DateResource extends AbstractResource
{
    /** @var string */
    protected $iso;

    /** @var string */
    protected $timezone;

    /**
     * Return the ISO8601 date.
     */
    public function getIso(): string
    {
        return $this->iso;
    }

    /**
     * Set the ISO8601 date.
     *
     * @param string $iso
     */
    public function setIso(string $iso): void
    {
        $this->iso = $iso;
    }

    /**
     * Return the timezone.
     */
    public function getTimezone(): string
    {
        return $this->timezone;
    }

    /**
     * Set the timezone.
     *
     * @param string $timezone
     */
    public function setTimezone(string $timezone): void
    {
        $this->timezone = $timezone;
    }

    /**
     * Convert to a date time instance.
     *
     * @throws Exception Because DateTimeImmutable throws it for some reason.
     */
    public function asDateTime(): DateTimeInterface
    {
        return new DateTimeImmutable($this->iso);
    }
}
