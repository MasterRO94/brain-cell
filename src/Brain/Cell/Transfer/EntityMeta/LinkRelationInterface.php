<?php

namespace Brain\Cell\Transfer\EntityMeta;

/**
 * An interface containing all the constants for use with the {@link Link}.
 */
interface LinkRelationInterface
{
    /**
     * Used to provide the absolute link to itself.
     */
    const REL_SELF = 'self';

    /**
     * Used to provide the absolute link to create an instance of itself.
     */
    const REL_CREATE = 'create';
}
