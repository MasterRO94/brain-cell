<?php

declare(strict_types=1);

namespace Brain\Cell\Prototype\Column\Date;

use Brain\Cell\EntityResource\Common\DateResource;

use DateTime;
use DateTimeInterface;

trait DeletedAtTrait
{
    /** @var DateResource */
    protected $deletedAt;

    /**
     * Return the date deleted at.
     */
    public function getDeletedAt(): DateResource
    {
        return $this->deletedAt;
    }

    /**
     * Set the date deleted at.
     *
     * @internal Note this has no affect when posting resources.
     */
    public function setDeletedAt(DateResource $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * Return the date create at.
     *
     * @deprecated Consider using the "deletedAt" methods instead, this method will be removed.
     */
    public function getDeleted(): DateTimeInterface
    {
        return $this->deletedAt->asDateTime();
    }

    /**
     * @deprecated This method will be removed.
     */
    public function setDeleted(DateTime $deleted): void
    {
    }
}
