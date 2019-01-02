<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\File;

interface FilePreviewResourceInterface
{
    /**
     * Return the file preview index.
     */
    public function getIndex(): int;

    /**
     * Return the file for this preview.
     */
    public function getFile(): FileResourceInterface;
}
