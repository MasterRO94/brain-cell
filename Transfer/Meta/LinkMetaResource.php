<?php

namespace Brain\Cell\Transfer\Meta;

use Brain\Cell\Transfer\AbstractResource;

class LinkMetaResource extends AbstractResource
{

    const REL_SELF = 'self';

    /** @var int */
    protected $id;

    /** @var string */
    protected $rel;

    /** @var string */
    protected $href;

    /**
     * @param int $id
     * @param string $rel
     * @param string $href
     * @return $this;
     */
    public function setup($id, $rel, $href)
    {
        $this->id = $id;
        $this->rel = $rel;
        $this->href = $href;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getRel()
    {
        return $this->rel;
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

}
