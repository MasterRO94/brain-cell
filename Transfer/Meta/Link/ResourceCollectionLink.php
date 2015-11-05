<?php

namespace Brain\Cell\Transfer\Meta\Link;

use Brain;
use Brain\Cell\Transfer\AbstractResource;

class ResourceCollectionLink extends AbstractResource implements
    Brain\Cell\Transfer\Meta\LinkInterface
{

    /** @var string */
    protected $rel;

    /** @var string */
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
