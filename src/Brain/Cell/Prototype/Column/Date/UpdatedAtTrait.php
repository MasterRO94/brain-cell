<?php

declare(strict_types=1);

namespace Brain\Cell\Prototype\Column\Date;

use Brain\Cell\EntityResource\Common\DateResourceInterface;

use DateTime;
use DateTimeInterface;

trait UpdatedAtTrait
{
    /** @var DateResourceInterface */
    protected $updatedAt;

    /**
     * Return the date updated at.
     */
    public function getUpdatedAt(): DateResourceInterface
    {
        return $this->updatedAt;
    }

    /**
     * Set the date updated at.
     *
     * @internal Note this has no affect when posting resources.
     */
    public function setUpdatedAt(DateResourceInterface $updatedAt): void
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
     * @deprecated This method will be removed.
     */
    public function setUpdated(DateTime $updated): void
    {
    }
}
