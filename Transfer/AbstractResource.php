<?php

namespace Brain\Cell\Transfer;

use Brain;

abstract class AbstractResource implements
    Brain\Cell\TransferEntityInterface
{

    /**
     * @return string[]|null
     */
    public function getAssociatedResources()
    {
        return null;
    }

    /**
     * @return string[]|null
     */
    public function getAssociatedCollections()
    {
        return null;
    }

}
