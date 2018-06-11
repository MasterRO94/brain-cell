<?php

namespace Brain\Cell\EntityResource;

use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getIso()
    {
        return $this->iso;
    }

    /**
     * @param string $iso
     */
    public function setIso($iso)
    {
        $this->iso = $iso;
    }

    /**
     * @return string
     */
    public function getIso3()
    {
        return $this->iso3;
    }

    /**
     * @param string $iso3
     */
    public function setIso3($iso3)
    {
        $this->iso3 = $iso3;
    }
}
