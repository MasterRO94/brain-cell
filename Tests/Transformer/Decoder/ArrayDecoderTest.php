<?php

namespace Brain\Cell\Tests\Transformer\Decoder;

use Brain\Cell\Exception\RuntimeException;
use Brain\Cell\Service\TransferEntityMetaManagerService;
use Brain\Cell\Tests\BaseTestCase;
use Brain\Cell\Tests\Mock\Association\SimpleResourceAssociationMock;
use Brain\Cell\Tests\Mock\Association\SimpleResourceCollectionAssociationMock;
use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;
use Brain\Cell\Transformer\ArrayDecoder;

/**
 * @group cell
 * @group transformer
 * @group transformer-decoder
 */
class ArrayDecoderTest extends BaseTestCase
{

    /** @var ArrayDecoder */
    protected $decoder;

    /** @var TransferEntityMetaManagerService */
    protected $manager;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->manager = new TransferEntityMetaManagerService;
        $this->decoder = new ArrayDecoder($this->manager);
    }

    /**
     * @test
     *
     * @expectedException RuntimeException
     * @expectedExceptionMessage The given $data must be an array
     */
    public function decoderWillThrowOnInvalidData()
    {
        $this->decoder->decode(new SimpleResourceMock, null);
    }

    /**
     * @test
     *
     * @expectedException RuntimeException
     * @expectedExceptionMessage Unexpected TransferEntityInterface
     */
    public function decoderWillThrowOnInvalidTransferEntityInterface()
    {

        /** @var TransferEntityInterface $entity */
        $entity = $this->getMock(TransferEntityInterface::CLASS);

        $this->decoder->decode($entity, []);

    }

    /**
     * @test
     *
     * @expectedException RuntimeException
     * @expectedExceptionMessage The ResourceCollection $data is not formatted correctly
     */
    public function decoderWillThrowWithInvalidCollectionData()
    {
        $this->decoder->decode(new ResourceCollection, [1, 2, 3]);
    }

    /**
     * @test
     */
    public function decodingSimpleResources()
    {

        $data = [
            'id' => 1,
            'name' => 'string'
        ];

        /** @var SimpleResourceMock $response */
        $response = $this->decoder->decode(new SimpleResourceMock, $data);
        $this->assertInstanceOf(SimpleResourceMock::CLASS, $response, 'Decoder should return the given TransferEntityInterface');

        $this->assertEquals($data['id'], $response->getId());
        $this->assertEquals($data['name'], $response->getName());

    }

    /**
     * @test
     */
    public function decoderWillIgnoreExtraProperties()
    {

        $data = [
            'id' => 100,
            'name' => 'Tony Stark',
            'occupation' => 'Marvelous Super Hero'
        ];

        /** @var SimpleResourceMock $resource */
        $resource = $this->decoder->decode(new SimpleResourceMock, $data);

        $this->assertEquals(100, $resource->getId());
        $this->assertEquals('Tony Stark', $resource->getName());

    }

    /**
     * @test
     */
    public function decodeSimpleResourcesWithAssociations()
    {

        $data = [
            'id' => 2,
            'association' => [
                'id' => 1,
                'name' => 'string'
            ]
        ];

        /** @var SimpleResourceAssociationMock $response */
        $response = $this->decoder->decode(new SimpleResourceAssociationMock, $data);
        $this->assertInstanceOf(SimpleResourceAssociationMock::CLASS, $response, 'Decoder should return the given TransferEntityInterface');

        $this->assertEquals($data['id'], $response->getId());

        $association = $response->getAssociation();
        $this->assertInstanceOf(SimpleResourceMock::CLASS, $association);
        $this->assertEquals($data['association']['id'], $association->getId());
        $this->assertEquals($data['association']['name'], $association->getName());

    }

    /**
     * @test
     */
    public function decodeSimpleResourceCollections()
    {

        $data = [
            'data' => [
                ['id' => 1, 'name' => 'one'],
                ['id' => 2, 'name' => 'two']
            ]
        ];

        $collection = new ResourceCollection;
        $collection->setEntityClass(SimpleResourceMock::CLASS);

        /** @var ResourceCollection $collection */
        $collection = $this->decoder->decode($collection, $data);
        $this->assertInstanceOf(ResourceCollection::CLASS, $collection, 'Decoder should return the given TransferEntityInterface');

        foreach ($collection as $resource) {
            $this->assertInstanceOf(SimpleResourceMock::CLASS, $resource);
            $this->assertNotNull($resource->getId());
            $this->assertNotNull($resource->getName());
        }

    }

    /**
     * @test
     */
    public function decodeSimpleResourceCollectionsAsAssociations()
    {

        $data = [
            'id' => 3,
            'associations' => [
                'data' => [
                    ['id' => 1, 'name' => 'one'],
                    ['id' => 2, 'name' => 'two'],
                    ['id' => 3, 'name' => 'three']
                ]
            ]
        ];

        /** @var SimpleResourceCollectionAssociationMock $response */
        $response = $this->decoder->decode(new SimpleResourceCollectionAssociationMock, $data);
        $this->assertInstanceOf(SimpleResourceCollectionAssociationMock::CLASS, $response, 'Decoder should return the given TransferEntityInterface');

        $this->assertEquals($data['id'], $response->getId());

        $collection = $response->getAssociations();
        $this->assertInstanceOf(ResourceCollection::CLASS, $collection, 'Collection should have been created');

        foreach ($collection as $resource) {
            $this->assertInstanceOf(SimpleResourceMock::CLASS, $resource);
            $this->assertNotNull($resource->getId());
            $this->assertNotNull($resource->getName());
        }

    }

}
