<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource;

use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\DeletedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;

class AbstractNoteResource extends AbstractResource
{
    use CreatedAtTrait;
    use DeletedAtTrait;
    use UpdatedAtTrait;

    /** @var string */
    protected $id;

    /** @var string */
    protected $description;

    /** @var  ClientResource */
    protected $origin;

    /** @var string */
    protected $canonical;

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

    public function getId(): string
    {
        return $this->id;
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
}
