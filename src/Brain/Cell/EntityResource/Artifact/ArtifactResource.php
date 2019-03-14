<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Artifact;

use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\File\FileResource;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;

class ArtifactResource extends AbstractResource
{
    use CreatedAtTrait;
    use UpdatedAtTrait;

    /** @var string */
    protected $id;

    /** @var string */
    protected $path;

    /** @var string */
    protected $status;

    /** @var FileResource */
    protected $file;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'createdAt' => DateResource::class,
            'updatedAt' => DateResource::class,
            'file' => FileResource::class,
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getFile(): FileResource
    {
        return $this->file;
    }

    public function setFile(FileResource $file): void
    {
        $this->file = $file;
    }
}
