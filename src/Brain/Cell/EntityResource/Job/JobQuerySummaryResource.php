<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

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

    /** @var ResourceCollection|JobQueryNoteSuggestionResourceInterface[] */
    protected $noteSuggestions;

    public function __construct()
    {
        $this->noteSuggestions = new ResourceCollection();
        $this->noteSuggestions->setEntityClass(JobQueryNoteSuggestionResource::class);
    }

    public function getAssociatedCollections(): array
    {
        return [
            'noteSuggestions' => JobQueryNoteSuggestionResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getCanonical(): string
    {
        return $this->canonical;
    }

    public function setCanonical(string $canonical): void
    {
        $this->canonical = $canonical;
    }

    /**
     * {@inheritdoc}
     */
    public function getReadable(): string
    {
        return $this->readable;
    }

    public function setReadable(string $readable): void
    {
        $this->readable = $readable;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * {@inheritdoc}
     */
    public function getIsExternal(): bool
    {
        return $this->isExternal;
    }

    public function setIsExternal(bool $isExternal): void
    {
        $this->isExternal = $isExternal;
    }

    /**
     * {@inheritdoc}
     */
    public function getNoteSuggestions(): ResourceCollection
    {
        return $this->noteSuggestions;
    }
}
