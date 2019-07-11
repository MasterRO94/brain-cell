<?php

declare(strict_types=1);

namespace Brain\Cell\Prototype\Column\Date;

use Brain\Cell\EntityResource\Common\DateResourceInterface;

trait CreatedAtTrait
{
    /** @var DateResourceInterface */
    protected $createdAt;

    /**
     * Return the date created at.
     */
    public function getCreatedAt(): DateResourceInterface
    {
        return $this->createdAt;
    }

    /**
     * Set the date created at.
     *
     * @internal Note this has no affect when posting resources.
     */
    public function setCreatedAt(DateResourceInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
