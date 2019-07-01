<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Common;

use Brain\Cell\Transfer\AbstractResource;

use DateTimeImmutable;
use DateTimeInterface;

final class DateResource extends AbstractResource implements DateResourceInterface
{
    /** @var string */
    protected $iso;

    /** @var string */
    protected $timezone;

    /**
     * {@inheritdoc}
     */
    public function getIso(): string
    {
        return $this->iso;
    }

    /**
     * {@inheritdoc}
     */
    public function setIso(string $iso): void
    {
        $this->iso = $iso;
    }

    /**
     * {@inheritdoc}
     */
    public function getTimezone(): string
    {
        return $this->timezone;
    }

    /**
     * {@inheritdoc}
     */
    public function setTimezone(string $timezone): void
    {
        $this->timezone = $timezone;
    }

    /**
     * {@inheritdoc}
     */
    public function asDateTime(): DateTimeInterface
    {
        return new DateTimeImmutable($this->iso);
    }
}
