<?php

namespace Brain\Cell\Transfer\EntityMeta;

use Brain;

/**
 * A representation of a link to other resources and resource collections.
 *
 * @see LinkRelationInterface
 */
class Link implements
    Brain\Cell\Transfer\EntityMeta\LinkRelationInterface
{
    /**
     * The rel.
     *
     * @see LinkRelationInterface
     *
     * @var string
     */
    protected $rel;

    /**
     * The href.
     *
     * @var string
     */
    protected $href;

    /**
     * @param string $rel
     * @param string $href
     */
    public function __construct($rel, $href)
    {
        $this->rel = $rel;
        $this->href = $href;
    }

    /**
     * Return the rel.
     *
     * @see LinkRelationInterface
     *
     * @return string
     */
    public function getRel()
    {
        return $this->rel;
    }

    /**
     * Return the href.
     *
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }
}
