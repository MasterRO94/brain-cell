<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\File;

use Brain\Cell\TransferEntityInterface;

interface FilePreviewResourceInterface extends
    TransferEntityInterface
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
