<?php

namespace Brain\Cell\EntityResource\Artwork;

use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class ArtworkResource extends AbstractResource
{
    const STATUS_NEW = 1;
    const STATUS_PENDING_DOWNLOAD = 2;
    const STATUS_PENDING_VALIDATION = 3;
    const STATUS_INVALID_MIME_TYPE = 100;
    const STATUS_VERIFIED = 200;

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
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'status' => ArtworkStatusResource::class,
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

}
