<?php

namespace Brain\Cell\EntityResource\File;

use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\DeletedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

final class FileResource extends AbstractResource
{
    use ResourcePublicIdTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;
    use DeletedAtTrait;

    /** @var string */
    protected $source;

    /** @var string */
    protected $mimeType;

    /** @var string */
    protected $path;

    /** @var ResourceCollection|FilePreviewResource[] */
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
     * Return the source path.
     *
     * @internal This property is never returned from the API.
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * Set the source path for the file.
     *
     * @param string $source
     */
    public function setSource(string $source): void
    {
        $this->source = $source;
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

    /**
     * @return ResourceCollection|FilePreviewResource[]
     */
    public function getPreviews(): ResourceCollection
    {
        return $this->previews;
    }

    /**
     * @param ResourceCollection|FilePreviewResource[] $previews
     */
    public function setPreviews(ResourceCollection $previews): void
    {
        $this->previews = $previews;
    }
}
