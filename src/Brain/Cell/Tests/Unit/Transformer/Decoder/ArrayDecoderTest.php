<?php

namespace Brain\Cell\Tests\Unit\Transformer\Decoder;

use Brain\Cell\Exception\RuntimeException;
use Brain\Cell\Tests\AbstractBrainCellTestCase;
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
class ArrayDecoderTest extends AbstractBrainCellTestCase
{
    /** @var ArrayDecoder */
    protected $decoder;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->decoder = new ArrayDecoder();
    }

    /**
     * @test
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Unexpected TransferEntityInterface
     */
    public function decoderWillThrowOnInvalidTransferEntityInterface()
    {

        /** @var TransferEntityInterface $entity */
        $entity = $this->createMock(TransferEntityInterface::class);

        $this->decoder->decode($entity, []);
    }

    /**
     * @test
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage The ResourceCollection has no entity class set
     */
    public function decoderWillThrowWithCollectionMissingEntityClass()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(
            sprintf(
                'Missing entity class for collection',
                ResourceCollection::class
            )
        );

        $this->decoder->decode(new ResourceCollection(), [1, 2, 3]);
    }

    /**
     * @test
     */
    public function decodingSimpleResources()
    {
        $data = [
            'id' => 1,
            'name' => 'string',
        ];

        /** @var SimpleResourceMock $response */
        $response = $this->decoder->decode(new SimpleResourceMock(), $data);
        $this->assertInstanceOf(SimpleResourceMock::class, $response, 'Decoder should return the given TransferEntityInterface');

        $this->assertEquals($data['id'], $response->getId());
        $this->assertEquals($data['name'], $response->getName());
    }

    /**
     * @test
     */
    public function decoderWillNotThrowWithAdditionalData()
    {
        $data = [
            'id' => 100,
            'name' => 'Tony Stark',
            'occupation' => 'Marvelous Super Hero',
        ];

        /** @var SimpleResourceMock $resource */
        $resource = $this->decoder->decode(new SimpleResourceMock(), $data);

        $this->assertEquals(100, $resource->getId());
        $this->assertEquals('Tony Stark', $resource->getName());
    }

    /**
     * @disabled-test
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Missing property "name"
     */
    public function decoderWillThrowWithMissingProperties()
    {
        $data = [
            'id' => 100,
        ];

        $this->decoder->decode(new SimpleResourceMock(), $data);
    }

    /**
     * @test
     */
    public function decodeSimpleResourcesWithAssociations()
    {
        $data = [
            'id' => 2,
            'associatedResource' => [
                'id' => 1,
                'name' => 'string',
            ],
        ];

        /** @var SimpleResourceAssociationMock $response */
        $response = $this->decoder->decode(new SimpleResourceAssociationMock(), $data);
        $this->assertInstanceOf(SimpleResourceAssociationMock::class, $response, 'Decoder should return the given TransferEntityInterface');

        $this->assertEquals($data['id'], $response->getId());

        $association = $response->getAssociatedResource();
        $this->assertInstanceOf(SimpleResourceMock::class, $association);
        $this->assertArrayHasKey('associatedResource', $data);
        $this->assertEquals($data['associatedResource']['id'], $association->getId());
        $this->assertEquals($data['associatedResource']['name'], $association->getName());
    }

    /**
     * @test
     */
    public function decodeSimpleResourceCollections()
    {
        $data = [
            ['id' => 1, 'name' => 'one'],
            ['id' => 2, 'name' => 'two'],
        ];

        $collection = new ResourceCollection();
        $collection->setEntityClass(SimpleResourceMock::class);

        /** @var ResourceCollection $collection */
        $collection = $this->decoder->decode($collection, $data);
        $this->assertInstanceOf(ResourceCollection::class, $collection, 'Decoder should return the given TransferEntityInterface');

        foreach ($collection as $resource) {
            $this->assertInstanceOf(SimpleResourceMock::class, $resource);
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
            'associatedCollection' => [
                ['id' => 1, 'name' => 'one'],
                ['id' => 2, 'name' => 'two'],
                ['id' => 3, 'name' => 'three'],
            ],
        ];

        /** @var SimpleResourceCollectionAssociationMock $response */
        $response = $this->decoder->decode(new SimpleResourceCollectionAssociationMock(), $data);
        $this->assertInstanceOf(SimpleResourceCollectionAssociationMock::class, $response, 'Decoder should return the given TransferEntityInterface');

        $this->assertEquals($data['id'], $response->getId());

        $collection = $response->getAssociatedCollection();
        $this->assertInstanceOf(ResourceCollection::class, $collection, 'Collection should have been created');

        foreach ($collection as $resource) {
            $this->assertInstanceOf(SimpleResourceMock::class, $resource);
            $this->assertNotNull($resource->getId());
            $this->assertNotNull($resource->getName());
        }
    }
}
