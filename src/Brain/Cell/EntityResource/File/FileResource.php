<?php

namespace Brain\Cell\EntityResource\File;

use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\DeletedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;

final class FileResource extends AbstractResource
{
    use ResourcePublicIdTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;
    use DeletedAtTrait;

    /** @var string */
    protected $sourcePath;

    /** @var string */
    protected $mimeType;

    /** @var string */
    protected $path;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'createdAt' => DateResource::class,
            'updatedAt' => DateResource::class,
            'deletedAt' => DateResource::class,
        ];
    }

    /**
     * Return the source path.
     *
     * @internal This property is never returned from the API.
     */
    public function getSourcePath(): string
    {
        return $this->sourcePath;
    }

    /**
     * Set the source path for the file.
     *
     * @param string $sourcePath
     */
    public function setSourcePath(string $sourcePath): void
    {
        $this->sourcePath = $sourcePath;
    }

    /**
     * Return the mime type of the file.
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * Set the mime type of the file.
     *
     * @param string $mimeType
     */
    public function setMimeType(string $mimeType): void
    {
        $this->mimeType = $mimeType;
    }

    /**
     * Return the download path.
     *
     * This property is a virtual property and will only be returned from the API.
     */
    public function getPath(): string
    {
        return $this->path;
    }
}
