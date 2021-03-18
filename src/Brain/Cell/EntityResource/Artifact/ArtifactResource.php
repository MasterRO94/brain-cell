<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Artifact;

use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\File\FileResource;
use Brain\Cell\EntityResource\File\FileResourceInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;

class ArtifactResource extends AbstractResource implements 
    ArtifactResourceInterface
{
    use CreatedAtTrait;
    use UpdatedAtTrait;
    use ResourceIdentityTrait;

    /** @var string */
    protected $path;

    /** @var string */
    protected $status;

    /** @var FileResourceInterface */
    protected $file;

    /** @var mixed[] */
    protected $metaData;

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

    public function getFile(): FileResourceInterface
    {
        return $this->file;
    }

    public function setFile(FileResourceInterface $file): void
    {
        $this->file = $file;
    }

    /**
     * @return mixed[]
     */
    public function getMetaData(): array
    {
        return $this->metaData;
    }

    /**
     * @param mixed[] $metaData
     */
    public function setMetaData(array $metaData): void
    {
        $this->metaData = $metaData;
    }
}
