<?php

namespace Brain\Cell\EntityResource\Artwork;

use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class ArtworkResource extends AbstractResource
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $remotePath;

    /**
     * @var string
     */
    protected $internalPath;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return ArtworkResource
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getRemotePath()
    {
        return $this->remotePath;
    }

    /**
     * @param string $remotePath
     *
     * @return ArtworkResource
     */
    public function setRemotePath(string $remotePath)
    {
        $this->remotePath = $remotePath;
        return $this;
    }

    /**
     * @return string
     */
    public function getInternalPath()
    {
        return $this->internalPath;
    }

    /**
     * @param string $internalPath
     *
     * @return ArtworkResource
     */
    public function setInternalPath(string $internalPath)
    {
        $this->internalPath = $internalPath;
        return $this;
    }

}
