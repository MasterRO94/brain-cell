<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Artwork;

use Brain\Cell\EntityResource\AbstractNoteResource;

class ArtworkIssueResource extends AbstractNoteResource
{
    public const ARTWORK_ISSUE_PREFLIGHT = 'preflight';
    public const ARTWORK_ISSUE_DOCUMENT_ENCRYPTED = 'document_encrypted';
    public const ARTWORK_ISSUE_PAGE_COUNT_INVALID = 'page_count_invalid';
    public const ARTWORK_ISSUE_PAGE_TRIM_BOX_MISSING = 'page_trim_box_missing';
    public const ARTWORK_ISSUE_PAGE_TRIM_BOX_PLACEMENT = 'page_trim_box_placement';
    public const ARTWORK_ISSUE_PAGE_MEDIA_BOX_MISSING = 'page_media_box_missing';
    public const ARTWORK_ISSUE_PAGE_BLEED_BOX_PLACEMENT = 'page_bleed_box_placement';
}
