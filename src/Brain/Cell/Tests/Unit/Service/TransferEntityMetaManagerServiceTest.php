<?php

namespace Brain\Cell\Tests\Unit\Service;

use Brain\Cell\Service\TransferEntityMetaManagerService;
use Brain\Cell\Tests\AbstractBrainCellTestCase;
use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\EntityMeta\Link;
use Brain\Cell\Transfer\ResourceCollection;

use Pagerfanta\Pagerfanta;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * @group cell
 * @group service
 */
class TransferEntityMetaManagerServiceTest extends AbstractBrainCellTestCase
{

    /** @var TransferEntityMetaManagerService */
    protected $manager;

    /** @var MockObject|Pagerfanta */
    protected $paginatorMock;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->manager = new TransferEntityMetaManagerService;

        $builder = $this->getMockBuilder(Pagerfanta::CLASS);
        $builder->disableOriginalConstructor();

        $this->paginatorMock = $builder->getMock();
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

    /**
     * @test
     */
    public function managerDetectsPaginatorAgainstTransferEntities()
    {
        $resource = new SimpleResourceMock;

        $response = $this->manager->hasMetaPaginator($resource);

        $this->assertFalse($response, $this->paginatorMock);

        $this->manager->setMetaPaginator($resource, $this->paginatorMock);

        $response = $this->manager->hasMetaPaginator($resource);

        $this->assertTrue($response, 'Manager should detect meta paginator');
    }
}
