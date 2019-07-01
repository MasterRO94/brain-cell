<?php

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
    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @param string $label
     */
    public function setLabel(string $label): void;

    /**
     * @return FileResourceInterface
     */
    public function getFile(): FileResourceInterface;

    /**
     * @param FileResourceInterface $file
     */
    public function setFile(FileResourceInterface $file): void;

    /**
     * @return FinishingItemResourceInterface
     */
    public function getFinishingItem(): FinishingItemResourceInterface;

    /**
     * @param FinishingItemResourceInterface $finishingItem
     */
    public function setFinishingItem(FinishingItemResourceInterface $finishingItem): void;
}
