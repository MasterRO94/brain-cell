<?php

namespace Brain\Cell\EntityResource\Artwork;

use Brain\Cell\EntityResource\AbstractNoteResource;

class ArtworkIssueResource extends AbstractNoteResource
{
    const ARTWORK_ISSUE_PREFLIGHT = 'artwork_issue.validation.preflight';
    const ARTWORK_ISSUE_DOCUMENT_ENCRYPTED = 'artwork_issue.validation.document_encrypted';
    const ARTWORK_ISSUE_PAGE_COUNT_INVALID = 'artwork_issue.validation.page_count_invalid';
    const ARTWORK_ISSUE_PAGE_TRIM_BOX_MISSING = 'artwork_issue.validation.page_trim_box_missing';
    const ARTWORK_ISSUE_PAGE_TRIM_BOX_PLACEMENT = 'artwork_issue.validation.page_trim_box_placement';
    const ARTWORK_ISSUE_PAGE_MEDIA_BOX_MISSING = 'artwork_issue.validation.page_media_box_missing';
    const ARTWORK_ISSUE_PAGE_BLEED_BOX_PLACEMENT = 'artwork_issue.validation.page_bleed_box_placement';
}
