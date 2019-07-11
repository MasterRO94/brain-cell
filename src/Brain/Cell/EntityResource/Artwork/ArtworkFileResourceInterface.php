<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Artwork;

use Brain\Cell\EntityResource\File\FileResourceInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\EntityResource\Stock\Finishing\FinishingItemResourceInterface;
use Brain\Cell\Prototype\Column\Date\CreatedAtInterface;
use Brain\Cell\TransferEntityInterface;

interface ArtworkFileResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface,
    CreatedAtInterface
{
    public function getLabel(): string;

    public function setLabel(string $label): void;

    public function getFile(): FileResourceInterface;

    public function setFile(FileResourceInterface $file): void;

    public function getFinishingItem(): FinishingItemResourceInterface;

    public function setFinishingItem(FinishingItemResourceInterface $finishingItem): void;
}
