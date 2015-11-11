<?php

namespace Brain\Cell\Tests\Transformer\Encoder;

use Brain\Cell\Exception\RuntimeException;
use Brain\Cell\Service\TransferEntityMetaManagerService;
use Brain\Cell\Tests\BaseTestCase;
use Brain\Cell\Tests\Mock\Association\SimpleResourceAssociationMock;
use Brain\Cell\Tests\Mock\Association\SimpleResourceCollectionAssociationMock;
use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\EntityMeta\Link;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;
use Brain\Cell\Transformer\ArrayEncoder;

/**
 * @group cell
 * @group transformer
 * @group transformer-encoder
 */
class ArrayEncoderTest extends BaseTestCase
{

    /** @var ArrayEncoder */
    protected $encoder;

    /** @var TransferEntityMetaManagerService */
    protected $manager;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->manager = new TransferEntityMetaManagerService;
        $this->encoder = new ArrayEncoder($this->manager);
    }

    /**
     * @test
     *
     * @expectedException RuntimeException
     * @expectedExceptionMessage Unexpected TransferEntityInterface
     */
    public function encoderWillThrowOnInvalidTransferEntityInterface()
    {

        /** @var TransferEntityInterface $entity */
        $entity = $this->getMock(TransferEntityInterface::CLASS);

        $this->encoder->encode($entity);

    }

    /**
     * @test
     */
    public function encoderPopulatesMissingCollections()
    {
        $resource = SimpleResourceCollectionAssociationMock::create(10);

        $expected = [
            'id' => 10,
            'associations' => ['data' => []]
        ];

        $response = $this->encoder->encode($resource);
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     *
     * @expectedException RuntimeException
     * @expectedExceptionMessage Was not expected EntityResource at "name" of "Brain\Cell\Tests\Mock\SimpleResourceMock"
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
            'name' => 'string'
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
        $parent->setAssociation($resource);

        $expected = [
            'id' => 2,
            'association' => [
                'id' => 1,
                'name' => 'string'
            ]
        ];

        $response = $this->encoder->encode($parent);
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     */
    public function encodeSimpleResourceCollections()
    {
        $collection = new ResourceCollection;
        $collection->add(SimpleResourceMock::create(1, 'one'));
        $collection->add(SimpleResourceMock::create(2, 'two'));

        $expected = [
            'data' => [
                ['id' => 1, 'name' => 'one'],
                ['id' => 2, 'name' => 'two']
            ]
        ];

        $response = $this->encoder->encode($collection);
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     */
    public function encodeSimpleResourceCollectionsAsAssociations()
    {
        $collection = new ResourceCollection;
        $collection->add(SimpleResourceMock::create(1, 'one'));
        $collection->add(SimpleResourceMock::create(2, 'two'));
        $collection->add(SimpleResourceMock::create(3, 'three'));

        $resource = SimpleResourceCollectionAssociationMock::create(3);
        $resource->setAssociations($collection);

        $expected = [
            'id' => 3,
            'associations' => [
                'data' => [
                    ['id' => 1, 'name' => 'one'],
                    ['id' => 2, 'name' => 'two'],
                    ['id' => 3, 'name' => 'three']
                ]
            ]
        ];

        $response = $this->encoder->encode($resource);
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     */
    public function encodeSimpleResourceWithMetaLinks()
    {
        $resource = SimpleResourceMock::create(10, 'Tony Stark');
        $this->manager->addMetaLink($resource, new Link(Link::REL_SELF, 'https://domain/path/self'));
        $this->manager->addMetaLink($resource, new Link(Link::REL_CREATE, 'https://domain/path/create'));

        $expected = [
            'id' => 10,
            'name' => 'Tony Stark',
            '$links' => [
                Link::REL_SELF => 'https://domain/path/self',
                Link::REL_CREATE => 'https://domain/path/create'
            ]
        ];

        $response = $this->encoder->encode($resource);
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     */
    public function encodeResourceCollectionWithMetaLinks()
    {
        $collection = new ResourceCollection;
        $this->manager->addMetaLink($collection, new Link(Link::REL_SELF, 'https://domain/path/self'));
        $this->manager->addMetaLink($collection, new Link(Link::REL_CREATE, 'https://domain/path/create'));

        $expected = [
            'data' => [],
            '$links' => [
                Link::REL_SELF => 'https://domain/path/self',
                Link::REL_CREATE => 'https://domain/path/create'
            ]
        ];

        $response = $this->encoder->encode($collection);
        $this->assertEquals($expected, $response);

    }

}
