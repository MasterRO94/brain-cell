<?php

namespace Brain\Cell\EntityResource\Resource;

use Brain\Cell\Transfer\AbstractResource;

class PresignedAssetResource extends AbstractResource
{
    protected $url;

    protected $presignedUrl;

    protected $expiresAt;

    public function getDateTimeProperties()
    {
        return [
            'expiresAt',
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
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

}
