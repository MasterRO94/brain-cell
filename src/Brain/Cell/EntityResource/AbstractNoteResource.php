<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource;

use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\DeletedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;

class AbstractNoteResource extends AbstractResource
{
    use ResourceIdentityTrait;
    use CreatedAtTrait;
    use DeletedAtTrait;
    use UpdatedAtTrait;

    /** @var string */
    protected $description;

    /** @var  ClientResource */
    protected $origin;

    /** @var string */
    protected $canonical;

    /** @var mixed[] */
    protected $metaData;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'origin' => ClientResource::class,
            'createdAt' => DateResource::class,
            'updatedAt' => DateResource::class,
        ];
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getOrigin(): ClientResource
    {
        return $this->origin;
    }

    public function getCanonical(): string
    {
        return $this->canonical;
    }

    public function setCanonical(string $canonical): void
    {
        $this->canonical = $canonical;
    }

    /**
     * @return mixed[]
     */
    public function getMetaData(): array
    {
        return $this->metaData ?? [];
    }

    /**
     * @param mixed[] $metaData
     */
    public function setMetaData(array $metaData): void
    {
        $this->metaData = $metaData;
    }
}
