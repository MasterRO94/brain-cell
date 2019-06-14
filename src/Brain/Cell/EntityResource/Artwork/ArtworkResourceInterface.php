<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Artwork;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;

interface ArtworkResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface
{
    /**
     * @return ArtworkFileResource[]|ResourceCollection
     */
    public function getFiles(): ResourceCollection;

    /**
     * @param ArtworkFileResource[]|ResourceCollection $files
     */
    public function setFiles(ResourceCollection $files): void;

    public function getStatus(): ArtworkStatusResource;

    public function setStatus(ArtworkStatusResource $status): void;

    /**
     * @return ArtworkIssueResource[]|ResourceCollection|null
     */
    public function getIssues(): ?ResourceCollection;
}
