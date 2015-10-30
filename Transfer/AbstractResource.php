<?php

namespace Brain\Cell\Transfer;

use Brain;

abstract class AbstractResource implements
    Brain\Cell\TransferEntityInterface
{

    /**
     * @var bool
     */
    protected $___isResourceFullyHydrated = false;

    /**
     * @return bool
     *
     * @internal
     */
    public function isResourceFullyHydrated()
    {
        return $this->___isResourceFullyHydrated;
    }

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
