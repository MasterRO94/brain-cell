<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource;

use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class CountryResource extends AbstractResource
{
    /** @var string */
    protected $name;

    /**
     * @var string
     *
     * @Assert\Valid()
     * @Assert\Expression(
     *     expression="this.getIso() && strlen(this.getIso()) == 2",
     *     message="iso code "
     * )
     */
    protected $iso;

    /**
     * @var string
     * @Assert\Valid()
     * @Assert\Expression(
     *     expression="this.getIso3() && strlen(this.getIso3()) == 3",
     *     message="iso code "
     * )
     */
    protected $iso3;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getIso(): string
    {
        return $this->iso;
    }

    public function setIso(string $iso): void
    {
        $this->iso = $iso;
    }

    public function getIso3(): string
    {
        return $this->iso3;
    }

    public function setIso3(string $iso3): void
    {
        $this->iso3 = $iso3;
    }
}
