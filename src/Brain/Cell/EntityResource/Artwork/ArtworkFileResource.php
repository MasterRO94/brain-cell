<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Artwork;

use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\File\FileResource;
use Brain\Cell\EntityResource\File\FileResourceInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\EntityResource\Stock\Finishing\FinishingItemResource;
use Brain\Cell\EntityResource\Stock\Finishing\FinishingItemResourceInterface;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\DeletedAtTrait;
use Brain\Cell\Transfer\AbstractResource;

final class ArtworkFileResource extends AbstractResource implements ArtworkFileResourceInterface
{
    use CreatedAtTrait;
    use DeletedAtTrait;
    use ResourceIdentityTrait;

    /** @var string */
    protected $label;

    /** @var FileResourceInterface */
    protected $file;

    /** @var FinishingItemResourceInterface */
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
     * {@inheritdoc}
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * {@inheritdoc}
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * {@inheritdoc}
     */
    public function getFile(): FileResourceInterface
    {
        return $this->file;
    }

    /**
     * {@inheritdoc}
     */
    public function setFile(FileResourceInterface $file): void
    {
        $this->file = $file;
    }

    /**
     * {@inheritdoc}
     */
    public function getFinishingItem(): FinishingItemResourceInterface
    {
        return $this->finishingItem;
    }

    /**
     * {@inheritdoc}
     */
    public function setFinishingItem(FinishingItemResourceInterface $finishingItem): void
    {
        $this->finishingItem = $finishingItem;
    }
}
