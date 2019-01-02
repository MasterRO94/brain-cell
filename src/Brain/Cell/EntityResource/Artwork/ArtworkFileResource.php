<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Artwork;

use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\File\FileResource;
use Brain\Cell\EntityResource\File\FileResourceInterface;
use Brain\Cell\EntityResource\Stock\FinishingItemResource;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\DeletedAtTrait;
use Brain\Cell\Transfer\AbstractResource;

final class ArtworkFileResource extends AbstractResource
{
    use CreatedAtTrait;
    use DeletedAtTrait;

    /** @var string */
    protected $label;

    /** @var FileResource */
    protected $file;

    /** @var FinishingItemResource */
    protected $finishingItem;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'file' => FileResource::class,
            'finishingItem' => FinishingItemResource::class,
            'createdAt' => DateResource::class,
            'deletedAt' => DateResource::class,
        ];
    }

    /**
     * Return the artwork file label.
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Set the artwork file label.
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * Return the artwork file.
     */
    public function getFile(): FileResourceInterface
    {
        return $this->file;
    }

    /**
     * Set the artwork file.
     */
    public function setFile(FileResourceInterface $file): void
    {
        $this->file = $file;
    }

    /**
     * Return the associated finishing item.
     */
    public function getFinishingItem(): FinishingItemResource
    {
        return $this->finishingItem;
    }

    /**
     * Set the associated finishing item.
     */
    public function setFinishingItem(FinishingItemResource $finishingItem): void
    {
        $this->finishingItem = $finishingItem;
    }
}
