<?php

namespace Brain\Cell\EntityResource\File;

use Brain\Cell\Transfer\AbstractResource;

class FileDownloadPathResource extends AbstractResource
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }
}
