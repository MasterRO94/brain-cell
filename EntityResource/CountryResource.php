<?php

namespace Brain\Cell\EntityResource;

use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class CountryResource extends AbstractResource
{
    /**
     * @var string
     */
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

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getIso(): string
    {
        return $this->iso;
    }

    /**
     * @param string $iso
     */
    public function setIso(string $iso): void
    {
        $this->iso = $iso;
    }

    /**
     * @return string
     */
    public function getIso3(): string
    {
        return $this->iso3;
    }

    /**
     * @param string $iso3
     */
    public function setIso3(string $iso3): void
    {
        $this->iso3 = $iso3;
    }
}
