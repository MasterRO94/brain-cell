<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\File;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;

interface FileResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface
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
