<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Transfer\AbstractResource;

class JobGroupJobResource extends AbstractResource implements
    JobGroupJobResourceInterface
{
    use ResourceIdentityTrait;

    /** @var int|null */
    protected $index;

    /**
     * {@inheritdoc}
     */
    public function getIndex(): ?int
    {
        return $this->index;
    }

    /**
     * {@inheritdoc}
     */
    public function setIndex(?int $index): void
    {
        $this->index = $index;
    }
}
