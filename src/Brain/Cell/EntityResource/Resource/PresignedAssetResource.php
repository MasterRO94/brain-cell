<?php

namespace Brain\Cell\EntityResource\Resource;

use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\EntityResource\Common\DateResource;

class PresignedAssetResource extends AbstractResource
{
    protected $url;

    protected $presignedUrl;

    protected $expiresAt;

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
