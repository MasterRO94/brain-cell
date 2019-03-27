<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Artwork;

use Brain\Cell\EntityResource\Common\AbstractStatusResource;

/**
 * {@inheritdoc}
 */
class ArtworkStatusResource extends AbstractStatusResource
{
    public const STATUS_NEW = 'artwork.status.new';
    public const STATUS_VERIFIED = 'artwork.status.verified';
    public const STATUS_PENDING_DOWNLOAD = 'artwork.status.pending_download';
    public const STATUS_PENDING_VALIDATION = 'artwork.status.pending_validation';
    public const STATUS_PENDING_UPLOAD = 'artwork.status.pending_upload';
    public const STATUS_FAILED_DOWNLOAD = 'artwork.status.failed_download';
    public const STATUS_INVALID_MIME_TYPE = 'artwork.status.invalid_mime_type';
}
