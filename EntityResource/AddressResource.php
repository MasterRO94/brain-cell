<?php
/**
 * @maintainer Alex Moon <alex.moon@printed.com>
 */

namespace Brain\Cell\EntityResource;

use Brain\Cell\Transfer\AbstractResource;

class AddressResource extends AbstractResource
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var \DateTime
     */
    protected $updated;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $company;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $addressLine1;

    /**
     * @var string
     */
    protected $addressLine2;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $countyState;

    /**
     * @var string
     */
    protected $postcode;

    /**
     * @var array
     */
    protected $country;

    public function getUnstructuredFields()
    {
        // @todo this is bogus - write a CountryResource
        return [
            'country'
        ];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return AddressResource
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $company
     * @return AddressResource
     */
    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return AddressResource
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return AddressResource
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressLine1()
    {
        return $this->addressLine1;
    }

    /**
     * @param string $addressLine1
     * @return AddressResource
     */
    public function setAddressLine1($addressLine1)
    {
        $this->addressLine1 = $addressLine1;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressLine2()
    {
        return $this->addressLine2;
    }

    /**
     * @param string $addressLine2
     * @return AddressResource
     */
    public function setAddressLine2($addressLine2)
    {
        $this->addressLine2 = $addressLine2;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return AddressResource
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountyState()
    {
        return $this->countyState;
    }

    /**
     * @param string $countyState
     *
     * @return AddressResource
     */
    public function setCountyState($countyState)
    {
        $this->countyState = $countyState;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param string $postcode
     *
     * @return AddressResource
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
        return $this;
    }

    /**
     * @return array
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param array $country
     *
     * @return AddressResource
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
    }

    /**
     * @param \DateTime $updated
     */
    public function setUpdated(\DateTime $updated)
    {
        $this->updated = $updated;
    }

    /**
     * {@inheritdoc}
     */
    public function getAddressString()
    {
        return implode(', ', array_filter([
            $this->name,
            $this->addressLine1,
            $this->addressLine2,
            $this->city,
            $this->countyState,
            $this->postcode,
            $this->country
        ]));
    }

    /**
     * {@inheritdoc}
     */
    public function getDelimitedAddressString()
    {
        return implode(' | ', [
            $this->name,
            $this->addressLine1,
            $this->addressLine2,
            $this->city,
            $this->countyState,
            $this->postcode,
            $this->country
        ]);
    }
}
