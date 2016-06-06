<?php

namespace Brain\Cell\Tests\Transfer\EntityMeta;

use Brain\Cell\Tests\AbstractBrainCellTestCase;
use Brain\Cell\Transfer\EntityMeta\Link;

/**
 * @group cell
 * @group transfer
 * @group transfer-meta
 */
class LinkTest extends AbstractBrainCellTestCase
{

    /**
     * @test
     */
    public function basicLinkGetterAndSetter()
    {
        $link = new Link(Link::REL_SELF, 'Tony Stark');

        $this->assertEquals(Link::REL_SELF, $link->getRel());
        $this->assertEquals('Tony Stark', $link->getHref());

    }

}
