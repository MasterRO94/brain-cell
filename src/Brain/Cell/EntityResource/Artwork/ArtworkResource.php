<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Artwork;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

/**
 * {@inheritdoc}
 */
class ArtworkResource extends AbstractResource
{
    use ResourceIdentityTrait;

    /** @var string */
    protected $id;

    /** @var ArtworkStatusResource */
    protected $status;

    /** @var ArtworkFileResource[]|ResourceCollection */
    protected $files;

    /** @var ArtworkIssueResource[]|ResourceCollection */
    protected $issues;

    public function __construct()
    {
        $this->issues = new ResourceCollection();
        $this->issues->setEntityClass(ArtworkIssueResource::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'status' => ArtworkStatusResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections(): array
    {
        return [
            'files' => ArtworkFileResource::class,
            'issues' => ArtworkIssueResource::class,
        ];
    }

    /**
     * @return ArtworkFileResource[]|ResourceCollection
     */
    public function getFiles(): ResourceCollection
    {
        return $this->files;
    }

    /**
     * @param ArtworkFileResource[]|ResourceCollection $files
     */
    public function setFiles(ResourceCollection $files): void
    {
        $this->files = $files;
    }

    public function getStatus(): ArtworkStatusResource
    {
        return $this->status;
    }

    public function setStatus(ArtworkStatusResource $status): void
    {
        $this->status = $status;
    }

    /**
     * @return ArtworkIssueResource[]|ResourceCollection
     */
    public function getIssues(): ResourceCollection
    {
        return $this->issues;
    }
}
