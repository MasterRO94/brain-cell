<?php

namespace Brain\Cell\EntityResource\Artwork;

use Brain\Cell\EntityResource\Common\AbstractStatusResource;

/**
 * {@inheritdoc}
 */
class ArtworkStatusResource extends AbstractStatusResource
{
    const STATUS_NEW = 'artwork.status.new';
    const STATUS_VERIFIED = 'artwork.status.verified';
    const STATUS_PENDING_DOWNLOAD = 'artwork.status.pending_download';
    const STATUS_PENDING_VALIDATION = 'artwork.status.pending_validation';
    const STATUS_PENDING_UPLOAD = 'artwork.status.pending_upload';
    const STATUS_FAILED_DOWNLOAD = 'artwork.status.failed_download';
    const STATUS_INVALID_MIME_TYPE = 'artwork.status.invalid_mime_type';
}
