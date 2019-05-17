<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Artwork;

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

    /**
     * @return ArtworkStatusResource
     */
    public function getStatus(): ArtworkStatusResource

    public function setStatus(ArtworkStatusResource $status): void;

    /**
     * @return ArtworkIssueResource[]|ResourceCollection|null
     */
    public function getIssues(): ?ResourceCollection;
}
