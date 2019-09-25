<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\ClientResource;
use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

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

    /**
     * @return string
     */
    public function getCanonical(): string
    {
        return $this->canonical;
    }

    /**
     * @param string $canonical
     */
    public function setCanonical(string $canonical): void
    {
        $this->canonical = $canonical;
    }

    /**
     * @return string
     */
    public function getReadable(): string
    {
        return $this->readable;
    }

    /**
     * @param string $readable
     */
    public function setReadable(string $readable): void
    {
        $this->readable = $readable;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return bool
     */
    public function getIsExternal(): bool
    {
        return $this->isExternal;
    }

    /**
     * @param bool $isExternal
     */
    public function setIsExternal(bool $isExternal): void
    {
        $this->isExternal = $isExternal;
    }
}
