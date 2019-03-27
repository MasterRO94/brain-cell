<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Country;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\TransferEntityInterface;

/**
 * An address.
 */
interface AddressResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface
{
    /**
     * Return the name of the recipient at the address.
     */
    public function getName(): string;

    /**
     * Return the email of the recipient at the address.
     */
    public function getEmail(): string;

    /**
     * Return the phone number of the recipient at the address.
     */
    public function getPhone(): ?string;

    /**
     * Return the company name.
     *
     * Note; this will be NULL in cases where the address does not belong to a company.
     */
    public function getCompany(): ?string;

    public function getAddressLine1(): string;
    public function getAddressLine2(): ?string;
    public function getCity(): string;
    public function getCountyState(): ?string;
    public function getPostcode(): string;
    public function getCountry(): CountryResourceInterface;
}
