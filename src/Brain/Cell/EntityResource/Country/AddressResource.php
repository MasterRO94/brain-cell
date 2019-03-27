<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Country;

use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
class AddressResource extends AbstractResource implements
    AddressResourceInterface
{
    use ResourceIdentityTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;

    /** @var string */
    protected $name;

    /** @var string|null */
    protected $company;

    /** @var string */
    protected $email;

    /** @var string|null */
    protected $phone;

    /** @var string */
    protected $addressLine1;

    /** @var string|null */
    protected $addressLine2;

    /** @var string */
    protected $city;

    /** @var string|null */
    protected $countyState;

    /** @var string */
    protected $postcode;

    /** @var CountryResourceInterface */
    protected $country;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'country' => CountryResource::class,
            'createdAt' => DateResource::class,
            'updatedAt' => DateResource::class,
        ];
    }

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
    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): void
    {
        $this->company = $company;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * {@inheritdoc}
     */
    public function getAddressLine1(): string
    {
        return $this->addressLine1;
    }

    public function setAddressLine1(string $addressLine1): void
    {
        $this->addressLine1 = $addressLine1;
    }

    /**
     * {@inheritdoc}
     */
    public function getAddressLine2(): ?string
    {
        return $this->addressLine2;
    }

    public function setAddressLine2(?string $addressLine2): void
    {
        $this->addressLine2 = $addressLine2;
    }

    /**
     * {@inheritdoc}
     */
    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * {@inheritdoc}
     */
    public function getCountyState(): ?string
    {
        return $this->countyState;
    }

    public function setCountyState(?string $countyState): void
    {
        $this->countyState = $countyState;
    }

    /**
     * {@inheritdoc}
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): void
    {
        $this->postcode = $postcode;
    }

    /**
     * {@inheritdoc}
     */
    public function getCountry(): CountryResourceInterface
    {
        return $this->country;
    }

    public function setCountry(CountryResourceInterface $country): void
    {
        $this->country = $country;
    }

    /**
     * {@inheritdoc}
     */
    public function getAddressString()
    {
        return implode(', ', array_filter([
            $this->name,
            $this->company,
            $this->addressLine1,
            $this->addressLine2,
            $this->city,
            $this->countyState,
            $this->postcode,
            $this->country->getName(),
        ]));
    }

    /**
     * {@inheritdoc}
     */
    public function getDelimitedAddressString()
    {
        return implode(' | ', [
            $this->name,
            $this->company,
            $this->addressLine1,
            $this->addressLine2,
            $this->city,
            $this->countyState,
            $this->postcode,
            $this->country->getName(),
        ]);
    }
}
