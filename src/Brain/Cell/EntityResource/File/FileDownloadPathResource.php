<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\File;

use Brain\Cell\Transfer\AbstractResource;

/**
 * An exposed file download path.
 */
final class FileDownloadPathResource extends AbstractResource implements
    FileDownloadPathResourceInterface
{
    /** @var string */
    protected $path;

    /**
     * {@inheritdoc}
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @deprecated Do not use this, if its for test then mock the interface.
     *
     * Set the download path.
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }
}
