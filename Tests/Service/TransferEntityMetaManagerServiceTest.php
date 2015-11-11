<?php

namespace Brain\Cell\Tests\Service;

use Brain\Cell\Service\TransferEntityMetaManagerService;
use Brain\Cell\Tests\BaseTestCase;
use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\EntityMeta\Link;
use Brain\Cell\Transfer\ResourceCollection;

/**
 * @group cell
 * @group service
 */
class TransferEntityMetaManagerServiceTest extends BaseTestCase
{

    /** @var TransferEntityMetaManagerService */
    protected $manager;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->manager = new TransferEntityMetaManagerService;
    }

    /**
     * @test
     */
    public function managerDetectsMetaLinksAgainstTransferEntities()
    {
        $link = new Link(Link::REL_SELF, 'Tony Stark');

        $resource = new SimpleResourceMock;
        $response = $this->manager->hasMetaLinks($resource);
        $this->assertFalse($response, 'Manager should not detect meta links against a new resource');

        $this->manager->addMetaLink($resource, $link);
        $response = $this->manager->hasMetaLinks($resource);
        $this->assertTrue($response, 'Manager should detect meta links now set against the resource');

        $collection = new ResourceCollection;
        $response = $this->manager->hasMetaLinks($collection);
        $this->assertFalse($response, 'Manager should not detect meta links against a new resource collection');

        $this->manager->addMetaLink($collection, $link);
        $response = $this->manager->hasMetaLinks($collection);
        $this->assertTrue($response, 'Manage should detect meta links now set against the resource');

    }

}
