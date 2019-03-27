<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Resource;

use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\Transfer\AbstractResource;

class PresignedAssetResource extends AbstractResource
{
    /** @var string */
    protected $url;

    /** @var string */
    protected $presignedUrl;

    /** @var DateResource */
    protected $expiresAt;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'expiresAt' => DateResource::class,
        ];
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getPresignedUrl(): string
    {
        return $this->presignedUrl;
    }

    public function getExpiresAt(): DateResource
    {
        return $this->expiresAt;
    }
}
