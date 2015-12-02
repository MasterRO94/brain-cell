<?php

namespace Brain\Cell\Transfer;

use Brain\Cell\Transfer\EntityMeta\Link;

use Doctrine\Common\Collections\ArrayCollection;

use Pagerfanta\Pagerfanta;

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
     * The meta paginator object
     *
     * @var Pagerfanta
     */
    protected $paginator;

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

    /**
     * Return paginator object
     *
     * @return Pagerfanta
     */
    public function getPaginator()
    {
        return $this->paginator;
    }

    /**
     * Set paginator object
     *
     * @param Pagerfanta $pagerfanta
     * @return $this
     */
    public function setPaginator(Pagerfanta $pagerfanta)
    {
        $this->paginator = $pagerfanta;

        return $this;
    }
}
