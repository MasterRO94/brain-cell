<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Transfer\AbstractResource;

class JobQueryNoteSuggestionResource extends AbstractResource implements JobQueryNoteSuggestionResourceInterface
{
    use ResourceIdentityTrait;

    /** @var string */
    protected $canonical;

    /** @var string */
    protected $readable;

    /** @var string */
    protected $description;

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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
