<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource;

use Brain\Cell\Transfer\AbstractResource;

/**
 * A resource representing a user.
 */
class UserResource extends AbstractResource
{
    /**
     * The unique id.
     *
     * @var int
     */
    protected $id;

    /**
     * The email address.
     *
     * @var string
     */
    protected $email;

    /**
     * Return the id.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Return the email address.
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the email address.
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
