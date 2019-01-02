<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\File;

interface FileDownloadPathResourceInterface
{
    /**
     * Return the download path.
     */
    public function getPath(): string;
}
