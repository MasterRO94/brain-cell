<?php

declare(strict_types=1);

namespace Brain\Cell\Prototype\Column\Date;

use Brain\Cell\EntityResource\Common\DateResource;

use DateTime;
use DateTimeInterface;

trait CreatedAtTrait
{
    /** @var DateResource */
    protected $createdAt;

    /**
     * Return the date created at.
     */
    public function getCreatedAt(): DateResource
    {
        return $this->createdAt;
    }

    /**
     * Set the date created at.
     *
     * @internal Note this has no affect when posting resources.
     */
    public function setCreatedAt(DateResource $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Return the date create at.
     *
     * @deprecated Consider using the "createdAt" methods instead, this method will be removed.
     */
    public function getCreated(): DateTimeInterface
    {
        return $this->createdAt->asDateTime();
    }

    /**
     * @deprecated This method will be removed.
     */
    public function setCreated(DateTime $created): void
    {
    }
}
