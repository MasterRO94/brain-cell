<?php

namespace Brain\Cell\Prototype\Column\Date;

use Brain\Cell\EntityResource\Common\DateResource;

use DateTimeInterface;

trait UpdatedAtTrait
{
    /** @var DateResource */
    protected $updatedAt;

    /**
     * Return the date updated at.
     */
    public function getUpdatedAt(): DateResource
    {
        return $this->updatedAt;
    }

    /**
     * Set the date updated at.
     *
     * @internal Note this has no affect when posting resources.
     *
     * @param DateResource $updatedAt
     */
    public function setUpdatedAt(DateResource $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Return the date create at.
     *
     * @deprecated Consider using the "updatedAt" methods instead, this method will be removed.
     */
    public function getUpdated(): DateTimeInterface
    {
        return $this->updatedAt->asDateTime();
    }

    /**
     * @param \DateTime $updated
     *
     * @deprecated This method will be removed.
     */
    public function setUpdated(\DateTime $updated): void
    {
    }
}
