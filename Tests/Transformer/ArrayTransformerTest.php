<?php

namespace Brain\Cell\Tests\Transformer;

use Brain\Cell\Tests\BaseTestCase;
use Brain\Cell\Tests\Mock\Association\SimpleResourceAssociationMock;
use Brain\Cell\Tests\Mock\Association\SimpleResourceCollectionAssociationMock;
use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\Transformer\ArrayDecoder;
use Brain\Cell\Transformer\ArrayEncoder;

/**
 * @group cell
 * @group transformer
 */
class ArrayTransformerTest extends BaseTestCase
{

    /** @var ArrayEncoder */
    protected $encoder;

    /** @var ArrayDecoder */
    protected $decoder;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->encoder = new ArrayEncoder;
        $this->decoder = new ArrayDecoder;
    }

    /**
     * @return array
     *
     * @test
     */
    public function canEncodeSimpleResource()
    {
        $resource = SimpleResourceMock::create(1, 'string');

        $expected = [
            'id' => 1,
            'name' => 'string'
        ];

        $response = $this->encoder->encode($resource);
        $this->assertEquals($expected, $response);

        return $response;

    }

    /**
     * @param array $data
     *
     * @depends canEncodeSimpleResource
     * @test
     */
    public function canDecodeSimpleResourceAfterEncoding(array $data)
    {
        $entity = new SimpleResourceMock;

        /** @var SimpleResourceMock $response */
        $response = $this->decoder->decode($entity, $data);
        $this->assertInstanceOf(SimpleResourceMock::CLASS, $response, 'Decoder should return the given TransferEntityInterface');

        $this->assertEquals($data['id'], $response->getId());
        $this->assertEquals($data['name'], $response->getName());

    }

    /**
     * @return array
     *
     * @test
     */
    public function canEncodeSimpleResourceAssociations()
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

        return $response;

    }

    /**
     * @param array $data
     *
     * @depends canEncodeSimpleResourceAssociations
     * @test
     */
    public function canDecodeSimpleResourceAssociationsAfterEncoding(array $data)
    {
        $entity = new SimpleResourceAssociationMock;

        /** @var SimpleResourceAssociationMock $response */
        $response = $this->decoder->decode($entity, $data);
        $this->assertInstanceOf(SimpleResourceAssociationMock::CLASS, $response, 'Decoder should return the given TransferEntityInterface');

        $this->assertEquals($data['id'], $response->getId());

        $association = $response->getAssociation();
        $this->assertInstanceOf(SimpleResourceMock::CLASS, $association);
        $this->assertEquals($data['association']['id'], $association->getId());
        $this->assertEquals($data['association']['name'], $association->getName());

    }

    /**
     * @return array
     *
     * @test
     */
    public function canEncodeSimpleResourceCollection()
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

        return $response;

    }

    /**
     * @param array $data
     *
     * @depends canEncodeSimpleResourceCollection
     * @test
     */
    public function canDecodeSimpleResourceCollectionAfterEncoding(array $data)
    {
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
     * @return array
     *
     * @test
     */
    public function canEncodeSimpleResourceCollectionAssociations()
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

        return $response;

    }

    /**
     * @param array $data
     *
     * @depends canEncodeSimpleResourceCollectionAssociations
     * @test
     */
    public function canDecodeSimpleResourceCollectionAssociationAfterEncoding(array $data)
    {
        $entity = new SimpleResourceCollectionAssociationMock;

        /** @var SimpleResourceCollectionAssociationMock $response */
        $response = $this->decoder->decode($entity, $data);
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
