<?php

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
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return the email address.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the email address.
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

}
