<?php

namespace Brain\Cell\EntityResource\File;

use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;

class FilePreviewResource extends AbstractResource
{
    use ResourcePublicIdTrait;
    use CreatedAtTrait;

    public function getAssociatedResources(): array
    {
        return [
            'file' => FileResource::class,
        ];
    }

    /**
     * @var FileResource
     */
    protected $file;

    /**
     * @var int
     */
    protected $index;

    /**
     * @return FileResource
     */
    public function getFile(): FileResource
    {
        return $this->file;
    }

    /**
     * @param FileResource $file
     */
    public function setFile(FileResource $file): void
    {
        $this->file = $file;
    }

    /**
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }

    /**
     * @param int $index
     */
    public function setIndex(int $index)
    {
        $this->index = $index;
    }
}
