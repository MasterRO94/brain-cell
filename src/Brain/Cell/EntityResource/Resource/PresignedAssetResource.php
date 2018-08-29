<?php

namespace Brain\Cell\EntityResource\Resource;

use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\Transfer\AbstractResource;

class PresignedAssetResource extends AbstractResource
{
    protected $url;

    protected $presignedUrl;

    protected $expiresAt;

    public function getAssociatedResources(): array
    {
        return [
            'expiresAt' => DateResource::class,
        ];
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getPresignedUrl()
    {
        return $this->presignedUrl;
    }

    /**
     * @return DateResource
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }
}
