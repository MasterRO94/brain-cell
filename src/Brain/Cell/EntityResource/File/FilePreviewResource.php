<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\File;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;

/**
 * A file preview.
 */
final class FilePreviewResource extends AbstractResource implements
    FilePreviewResourceInterface
{
    use ResourceIdentityTrait;
    use CreatedAtTrait;

    /** @var int */
    protected $index;

    /** @var FileResource */
    protected $file;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'file' => FileResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getIndex(): int
    {
        return $this->index;
    }

    /**
     * Set the index.
     */
    public function setIndex(int $index): void
    {
        $this->index = $index;
    }

    /**
     * {@inheritdoc}
     */
    public function getFile(): FileResourceInterface
    {
        return $this->file;
    }

    /**
     * Set the preview file.
     */
    public function setFile(FileResourceInterface $file): void
    {
        $this->file = $file;
    }
}
