<?php

namespace Brain\Cell\Tests\Service;

use Brain\Cell\Service\ResourceSerialiserService;
use Brain\Cell\Tests\BaseTestCase;
use Brain\Cell\Tests\Service\ResourceSerialiserService\Resource\SimpleAssociatedResourceMock;
use Brain\Cell\Tests\Service\ResourceSerialiserService\Resource\SimpleResourceMock;
use Brain\Cell\Transfer\Meta\LinkMetaResource;

/**
 * @group cell
 */
class ResourceSerialiserServiceTest extends BaseTestCase
{

    /** @var ResourceSerialiserService */
    protected $service;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->service = new ResourceSerialiserService;
    }

    /**
     * @test
     */
    public function serviceCanSetIdentityWithoutSetter()
    {
        $resource = new SimpleResourceMock;
        $this->assertNull($resource->getId(), 'Resources should not have an "id" on construction');

        $this->service->setId($resource, 10);
        $this->assertEquals(10, $resource->getId(), 'Service should have been able to set "id" without a setter');

    }

    /**
     * @return string
     *
     * @test
     */
    public function serviceCanSerialiseSimpleResources()
    {
        $resource = new SimpleResourceMock;
        $resource->setName('Tony Stark');
        $resource->setReference('Iron Man');

        $this->service->setId($resource, 10);

        $json = $this->service->serialise($resource);

        $expected = '{"id":10,"name":"Tony Stark","reference":"Iron Man"}';
        $this->assertEquals($expected, $json, 'The serialised JSON is not as expected');

        return $json;

    }

    /**
     * @param string $json
     *
     * @depends serviceCanSerialiseSimpleResources
     * @test
     */
    public function serviceCanDeserialiseSimpleResources($json)
    {
        $json = json_decode($json, true);

        /** @var SimpleResourceMock $resource */
        $resource = $this->service->deserialise($json, SimpleResourceMock::CLASS);

        $this->assertEquals(10, $resource->getId(), 'SimpleResourceMock "id" was not populated');
        $this->assertEquals('Tony Stark', $resource->getName(), 'SimpleResourceMock "name" was not populated');
        $this->assertEquals('Iron Man', $resource->getReference(), 'SimpleResourceMock "reference" was not populated');

    }

    /**
     * @return string
     *
     * @test
     */
    public function serviceCanSerialiseResourceWithAssociationResource()
    {
        $association = new SimpleResourceMock;
        $this->service->setId($association, 10);

        $association->setName('Tony Stark');

        $resource = new SimpleAssociatedResourceMock;
        $this->service->setId($resource, 100);

        $resource->setName('Pepper Stark');
        $resource->setAssociation($association);

        $json = $this->service->serialise($resource);

        $expected = '{"id":100,"name":"Pepper Stark","association":{"id":10,"name":"Tony Stark","reference":null}}';
        $this->assertEquals($expected, $json, 'The serialised JSON is not as expected');

        return $json;

    }

    /**
     * @param string $json
     *
     * @depends serviceCanSerialiseResourceWithAssociationResource
     * @test
     */
    public function serviceCanDeserialiseResourceWithAssociationResource($json)
    {
        $json = json_decode($json, true);

        /** @var SimpleAssociatedResourceMock $resource */
        $resource = $this->service->deserialise($json, SimpleAssociatedResourceMock::CLASS);

        $this->assertEquals(100, $resource->getId(), 'SimpleAssociatedResourceMock "id" was not populated');
        $this->assertEquals('Pepper Stark', $resource->getName(), 'SimpleAssociatedResourceMock "name" was not populated');

        $association = $resource->getAssociation();
        $this->assertInstanceOf(SimpleResourceMock::CLASS, $association, 'Expected an instance of SimpleResourceMock to have been constructed');
        $this->assertEquals(10, $association->getId(), 'SimpleResourceMock "id" was not populated within an association');

    }

    /**
     * @test
     */
    public function serviceUnderstandsMetaLinkResources()
    {
        $link = new LinkMetaResource;
        $link->setup(100, LinkMetaResource::REL_SELF, '/clients/100');

        $this->assertEquals(100, $link->getId(), 'Link resource "id" getter failed');
        $this->assertEquals(LinkMetaResource::REL_SELF, $link->getRel(), 'Link resource "rel" getter failed');
        $this->assertEquals('/clients/100', $link->getHref(), 'Link resource "href" getter failed');

        $resource = new SimpleAssociatedResourceMock;
        $resource->setAssociation($link);

        $json = $this->service->serialise($resource);

        $expected = '{"id":null,"name":null,"association":{"id":100,"rel":"self","href":"\/clients\/100"}}';
        $this->assertEquals($expected, $json, 'The serialised JSON is not as expected');

        $json = json_decode($json, true);

        /** @var SimpleAssociatedResourceMock $response */
        $response = $this->service->deserialise($json, SimpleAssociatedResourceMock::CLASS);

        $this->assertInstanceOf(SimpleResourceMock::CLASS, $response->getAssociation());
        $this->assertEquals(100, $response->getAssociation()->getId());

    }

    /**
     * @test
     */
    public function serviceResourceIsFullyHydratedWorksAsExpected()
    {
        $simple = new SimpleResourceMock;

        $this->assertFalse($simple->isResourceFullyHydrated(), 'Resource should never bee constructed with "isResourceFullyHydrated" as true');

        /** @var SimpleResourceMock $deserialised */
        $deserialised = $this->service->deserialise($this->service->serialise($simple), SimpleResourceMock::CLASS);
        $this->assertTrue($deserialised->isResourceFullyHydrated(), 'Resource when hydrated should assume its fully hydrated"');

        $associated = new SimpleAssociatedResourceMock;

        $link = new LinkMetaResource;
        $link->setup(10, 'self', '/mans/iron');
        $associated->setAssociation($link);

        /** @var SimpleAssociatedResourceMock $deserialised */
        $deserialised = $this->service->deserialise($this->service->serialise($associated), SimpleAssociatedResourceMock::CLASS);
        $this->assertTrue($deserialised->isResourceFullyHydrated(), 'Resource when hydrated should assume its fully hydrated"');
        $this->assertFalse($deserialised->getAssociation()->isResourceFullyHydrated(), 'Resource when hydrated from a link meta should not assume its fully hydrated');

    }

}
