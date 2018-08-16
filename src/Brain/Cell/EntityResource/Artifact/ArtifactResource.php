<?php

namespace Brain\Cell\EntityResource\Artifact;

use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;

class ArtifactResource extends AbstractResource
{
    use CreatedAtTrait;
    use UpdatedAtTrait;

    /**
     * @var string
     */
    protected $id;

    /**
     * Remote URL to the Artifact.
     *
     * @var string
     */
    protected $path;

    /**
     * One of:
     *  - pending_download
     *  - downloaded
     *  - failed_download
     *  - failed_invalid_mime_type.
     *
     * @var string
     */
    protected $status;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'createdAt' => DateResource::class,
            'updatedAt' => DateResource::class,
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
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->id = $id;
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
     */
    public function setPath(string $path)
    {
        $this->path = $path;
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
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }
}
