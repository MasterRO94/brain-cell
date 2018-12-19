<?php

namespace Brain\Cell\EntityResource\File;

use Brain\Cell\Transfer\ResourceCollection;

interface FileResourceInterface
{
    /**
     * Return the source path.
     *
     * @internal This property is never returned from the API.
     */
    public function getSource(): string;

    /**
     * Return the mime type of the file.
     */
    public function getMimeType(): string;

    /**
     * Return the download path.
     *
     * This property is a virtual property and will only be returned from the API.
     */
    public function getPath(): string;

    /**
     * @return FilePreviewResource[]|ResourceCollection
     */
    public function getPreviews(): ResourceCollection;
}
