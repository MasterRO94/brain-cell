<?php

namespace Brain\Cell\Transfer\Meta\Link;

use Brain;
use Brain\Cell\Transfer\AbstractResource;

class ResourceLink extends AbstractResource implements
    Brain\Cell\Transfer\Meta\LinkInterface
{

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
     */
    public function __construct($id, $rel, $href)
    {
        $this->id = $id;
        $this->rel = $rel;
        $this->href = $href;
    }

    /**
     * @return int|null
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
