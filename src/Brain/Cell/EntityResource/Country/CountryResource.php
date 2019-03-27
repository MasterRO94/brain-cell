<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Country;

use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class CountryResource extends AbstractResource implements
    CountryResourceInterface
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $iso;

    /** @var string */
    protected $iso3;

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getIso(): string
    {
        return $this->iso;
    }

    public function setIso(string $iso): void
    {
        $this->iso = $iso;
    }

    /**
     * {@inheritdoc}
     */
    public function getIso3(): string
    {
        return $this->iso3;
    }

    public function setIso3(string $iso3): void
    {
        $this->iso3 = $iso3;
    }
}
