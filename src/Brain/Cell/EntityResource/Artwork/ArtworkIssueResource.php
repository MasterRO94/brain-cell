<?php

namespace Brain\Cell\EntityResource\Artwork;

use Brain\Cell\EntityResource\AbstractNoteResource;

class ArtworkIssueResource extends AbstractNoteResource
{
    const ARTWORK_ISSUE_PREFLIGHT = 'preflight';
    const ARTWORK_ISSUE_DOCUMENT_ENCRYPTED = 'document_encrypted';
    const ARTWORK_ISSUE_PAGE_COUNT_INVALID = 'page_count_invalid';
    const ARTWORK_ISSUE_PAGE_TRIM_BOX_MISSING = 'page_trim_box_missing';
    const ARTWORK_ISSUE_PAGE_TRIM_BOX_PLACEMENT = 'page_trim_box_placement';
    const ARTWORK_ISSUE_PAGE_MEDIA_BOX_MISSING = 'page_media_box_missing';
    const ARTWORK_ISSUE_PAGE_BLEED_BOX_PLACEMENT = 'page_bleed_box_placement';
}
