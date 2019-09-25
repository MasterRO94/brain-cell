<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;

class JobQuerySummaryResource extends AbstractResource implements JobQuerySummaryResourceInterface
{
    use ResourceIdentityTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;

    /** @var string */
    protected $canonical;

    /** @var string */
    protected $readable;

    /** @var string|null */
    protected $description;

    /** @var bool */
    protected $isExternal;

    public function getCanonical(): string
    {
        return $this->canonical;
    }

    public function setCanonical(string $canonical): void
    {
        $this->canonical = $canonical;
    }

    public function getReadable(): string
    {
        return $this->readable;
    }

    public function setReadable(string $readable): void
    {
        $this->readable = $readable;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getIsExternal(): bool
    {
        return $this->isExternal;
    }

    public function setIsExternal(bool $isExternal): void
    {
        $this->isExternal = $isExternal;
    }
}
