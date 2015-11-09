<?php

namespace Brain\Cell\Transfer;

use Brain;

abstract class AbstractResource implements
    Brain\Cell\TransferEntityInterface
{

    /**
     * @return string[]|null
     *
     * @internal
     */
    public function getAssociatedResources()
    {
        return null;
    }

    /**
     * @return string[]|null
     *
     * @internal
     */
    public function getAssociatedCollections()
    {
        return null;
    }

}
