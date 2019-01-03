<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\File;

use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\DeletedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

/**
 * A file.
 */
final class FileResource extends AbstractResource implements
    FileResourceInterface
{
    use ResourceIdentityTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;
    use DeletedAtTrait;

    /** @var string */
    protected $source;

    /** @var string */
    protected $mimeType;

    /** @var string */
    protected $path;

    /** @var FilePreviewResource[]|ResourceCollection */
    protected $previews;

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
     * {@inheritdoc}
     */
    public function getAssociatedCollections(): array
    {
        return [
            'previews' => FilePreviewResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * Set the source path for the file.
     */
    public function setSource(string $source): void
    {
        $this->source = $source;
    }

    /**
     * {@inheritdoc}
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * Set the mime type of the file.
     */
    public function setMimeType(string $mimeType): void
    {
        $this->mimeType = $mimeType;
    }

    /**
     * {@inheritdoc}
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * {@inheritdoc}
     */
    public function getPreviews(): ResourceCollection
    {
        return $this->previews;
    }

    /**
     * Set the file previews.
     *
     * @param FilePreviewResource[]|ResourceCollection $previews
     */
    public function setPreviews(ResourceCollection $previews): void
    {
        $this->previews = $previews;
    }
}
