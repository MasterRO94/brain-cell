<?php

namespace Brain\Cell\EntityResource\Artwork;

use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class ArtworkResource extends AbstractResource
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var ArtworkStatusResource
     */
    protected $status;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Url()
     */
    protected $path;

    /**
     * @var string
     */
    protected $mimeType;

    /**
     * @var ArtworkIssueResource[]|ResourceCollection
     */
    protected $issues;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'status' => ArtworkStatusResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'issues' => ArtworkIssueResource::class,
        ];
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ArtworkStatusResource
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param ArtworkStatusResource $status
     *
     * @return ArtworkResource
     */
    public function setStatus(ArtworkStatusResource $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     *
     * @return ArtworkResource
     */
    public function setPath(string $path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;
    }

    /**
     * @return ArtworkIssueResource[]|ResourceCollection
     */
    public function getIssues()
    {
        return $this->issues;
    }
}
