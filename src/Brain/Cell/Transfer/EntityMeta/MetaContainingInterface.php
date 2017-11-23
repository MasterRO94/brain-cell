<?php

namespace Brain\Cell\Transfer\EntityMeta;

use Brain\Cell\Transfer\EntityMeta;

/**
 * An interface to allow meta storage against an entity.
 */
interface MetaContainingInterface
{
    /**
     * Return the internal stored meta.
     *
     * @return EntityMeta
     *
     * @internal
     */
    public function getResourceMeta();
}
