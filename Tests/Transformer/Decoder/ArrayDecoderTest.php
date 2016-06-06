<?php

namespace Brain\Cell\Tests\Transformer\Decoder;

use Brain\Cell\Exception\RuntimeException;
use Brain\Cell\Service\TransferEntityMetaManagerService;
use Brain\Cell\Tests\AbstractBrainCellTestCase;
use Brain\Cell\Tests\Mock\Association\SimpleResourceAssociationMock;
use Brain\Cell\Tests\Mock\Association\SimpleResourceCollectionAssociationMock;
use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\EntityMeta\Link;
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
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(
            sprintf(
                'The "data" for "%s" (targeting "n/a") is missing',
                ResourceCollection::class
            )
        );

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
     *
     * @expectedException RuntimeException
     * @expectedExceptionMessage Additional property "occupation"
     */
    public function decoderWillThrowWithAdditionalProperties()
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
     *
     * @expectedException RuntimeException
     * @expectedExceptionMessage Missing property "name"
     */
    public function decoderWillThrowWithMissingProperties()
    {

        $data = [
            'id' => 100
        ];

        $this->decoder->decode(new SimpleResourceMock, $data);

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
                'name' => 'string'
            ]
        ];

        /** @var SimpleResourceAssociationMock $response */
        $response = $this->decoder->decode(new SimpleResourceAssociationMock, $data);
        $this->assertInstanceOf(SimpleResourceAssociationMock::CLASS, $response, 'Decoder should return the given TransferEntityInterface');

        $this->assertEquals($data['id'], $response->getId());

        $association = $response->getAssociatedResource();
        $this->assertInstanceOf(SimpleResourceMock::CLASS, $association);
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
            'associatedCollection' => [
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

        $collection = $response->getAssociatedCollection();
        $this->assertInstanceOf(ResourceCollection::CLASS, $collection, 'Collection should have been created');

        foreach ($collection as $resource) {
            $this->assertInstanceOf(SimpleResourceMock::CLASS, $resource);
            $this->assertNotNull($resource->getId());
            $this->assertNotNull($resource->getName());
        }

    }

    /**
     * @test
     */
    public function decodeSimpleResourceWithMetaLinks()
    {

        $data = [
            'id' => 10,
            'name' => 'Tony Stark',
            '$links' => [
                Link::REL_SELF => 'https://domain/path/self',
                Link::REL_CREATE => 'https://domain/path/create'
            ]
        ];

        $resource = $this->decoder->decode(new SimpleResourceMock, $data);
        $this->assertTrue($this->manager->hasMetaLinks($resource), 'Links should have been populated');

        $links = $this->manager->getMeta($resource)->getLinks();

        $link = $links[0];
        $this->assertEquals(Link::REL_SELF, $link->getRel(), 'The first link should be the self');
        $this->assertEquals('https://domain/path/self', $link->getHref());

        $link = $links[1];
        $this->assertEquals(Link::REL_CREATE, $link->getRel(), 'The second link should be the create');
        $this->assertEquals('https://domain/path/create', $link->getHref());

    }

    /**
     * @test
     */
    public function decodeResourceCollectionWithMetaLinks()
    {

        $data = [
            'data' => [],
            '$links' => [
                Link::REL_SELF => 'https://domain/path/self',
                Link::REL_CREATE => 'https://domain/path/create'
            ]
        ];

        $response = $this->decoder->decode(new ResourceCollection, $data);
        $this->assertTrue($this->manager->hasMetaLinks($response), 'Links should have been populated');

        $links = $this->manager->getMeta($response)->getLinks();

        $link = $links[0];
        $this->assertEquals(Link::REL_SELF, $link->getRel(), 'The first link should be the self');
        $this->assertEquals('https://domain/path/self', $link->getHref());

        $link = $links[1];
        $this->assertEquals(Link::REL_CREATE, $link->getRel(), 'The second link should be the create');
        $this->assertEquals('https://domain/path/create', $link->getHref());

    }

}
