<?php

namespace Brain\Cell\Transfer;

use Brain\Cell\Transfer\EntityMeta\Link;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * A entity meta store.
 */
class EntityMeta
{

    /**
     * The meta links.
     *
     * @var ArrayCollection|Link[]
     */
    protected $links;

    /**
     * Construct an new instance of {@link EntityMeta}.
     */
    public function __construct()
    {
        $this->links = new ArrayCollection;
    }

    /**
     * Return the meta links.
     *
     * @return ArrayCollection|Link[]
     */
    public function getLinks()
    {
        return $this->links;
    }

}
