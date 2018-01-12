<?php

namespace Brain\Cell\Tests\Unit\Transformer\Encoder;

use Brain\Cell\Service\TransferEntityMetaManagerService;
use Brain\Cell\Tests\AbstractBrainCellTestCase;
use Brain\Cell\Tests\Mock\Association\SimpleResourceAssociationMock;
use Brain\Cell\Tests\Mock\Association\SimpleResourceCollectionAssociationMock;
use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;
use Brain\Cell\Transformer\ArrayEncoder;

use Pagerfanta\Pagerfanta;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * @group cell
 * @group transformer
 * @group transformer-encoder
 */
class ArrayEncoderTest extends AbstractBrainCellTestCase
{
    /** @var ArrayEncoder */
    protected $encoder;

    /** @var TransferEntityMetaManagerService */
    protected $manager;

    /** @var MockObject|Pagerfanta */
    protected $paginatorMock;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->manager = new TransferEntityMetaManagerService();
        $this->encoder = new ArrayEncoder($this->manager);

        $builder = $this->getMockBuilder(Pagerfanta::class);
        $builder->disableOriginalConstructor();

        $this->paginatorMock = $builder->getMock();
    }

    /**
     * @test
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Unexpected TransferEntityInterface
     */
    public function encoderWillThrowOnInvalidTransferEntityInterface()
    {
        /** @var TransferEntityInterface $entity */
        $entity = $this->createMock(TransferEntityInterface::class);

        $this->encoder->encode($entity);
    }

    /**
     * @test
     */
    public function encoderRefusesToEncodeInvalidEntityResourceProperties()
    {
        $internal = SimpleResourceMock::create(1, 'Tony Stark');
        $resource = SimpleResourceMock::create(2, $internal);

        $this->encoder->encode($resource);
    }

    /**
     * @test
     */
    public function encodeSimpleResources()
    {
        $resource = SimpleResourceMock::create(1, 'string');

        $expected = [
            'id' => 1,
            'name' => 'string',
        ];

        $response = $this->encoder->encode($resource);
        $this->assertEquals($expected, $response);
    }

    /**
     * @test
     */
    public function encodeSimpleResourcesWithAssociations()
    {
        $resource = SimpleResourceMock::create(1, 'string');

        $parent = SimpleResourceAssociationMock::create(2);
        $parent->setAssociatedResource($resource);

        $expected = [
            'id' => 2,
            'associated_resource' => 1,
        ];

        $response = $this->encoder->encode($parent);
        $this->assertEquals($expected, $response);
    }

    /**
     * @test
     */
    public function encodeSimpleResourceCollections()
    {
        $collection = new ResourceCollection();
        $collection->add(SimpleResourceMock::create(1, 'one'));
        $collection->add(SimpleResourceMock::create(2, 'two'));

        $expected = [
            1,
            2,
        ];

        $response = $this->encoder->encode($collection);
        $this->assertEquals($expected, $response);
    }

    /**
     * @test
     */
    public function encodeSimpleResourceCollectionsAsAssociations()
    {
        $collection = new ResourceCollection();
        $collection->add(SimpleResourceMock::create(1, 'one'));
        $collection->add(SimpleResourceMock::create(2, 'two'));
        $collection->add(SimpleResourceMock::create(3, 'three'));

        $resource = SimpleResourceCollectionAssociationMock::create(4);
        $resource->setAssociatedCollection($collection);

        $expected = [
            'id' => 4,
            'associated_collection' => [
                1,
                2,
                3,
            ],
        ];

        $response = $this->encoder->encode($resource);
        $this->assertEquals($expected, $response);
    }
}