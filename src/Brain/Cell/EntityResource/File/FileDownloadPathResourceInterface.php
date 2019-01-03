<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\File;

use Brain\Cell\TransferEntityInterface;

interface FileDownloadPathResourceInterface extends
    TransferEntityInterface
{
    /**
     * Return the download path.
     */
    public function getPath(): string;
}
