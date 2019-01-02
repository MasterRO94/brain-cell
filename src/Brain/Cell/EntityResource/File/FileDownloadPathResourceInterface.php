<?php

namespace Brain\Cell\EntityResource\File;

interface FileDownloadPathResourceInterface
{
    /**
     * Return the download path.
     */
    public function getPath(): string;
}
