<?php

namespace Brain\Cell\Tests\Service;

use Brain\Cell\Service\ResourceSerialiserService;
use Brain\Cell\Tests\BaseTestCase;
use Brain\Cell\Tests\Service\ResourceSerialiserService\Resource\SimpleResourceMock;

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
        $decoded = json_decode($json, true);

        $this->assertEquals($resource->getId(), $decoded['id'], 'SimpleResourceMock "id" is not correct');
        $this->assertEquals($resource->getName(), $decoded['name'], 'SimpleResourceMock "name" is not correct');
        $this->assertEquals($resource->getReference(), $decoded['reference'], 'SimpleResourceMock "reference" is not correct');

        return $decoded;

    }

    /**
     * @param array $json
     *
     * @depends serviceCanSerialiseSimpleResources
     * @test
     */
    public function serviceCanDeserialiseSimpleResources(array $json)
    {
        /** @var SimpleResourceMock $resource */
        $resource = $this->service->deserialise($json, SimpleResourceMock::CLASS);

        $this->assertEquals(10, $resource->getId(), 'SimpleResourceMock "id" was not populated');
        $this->assertEquals('Tony Stark', $resource->getName(), 'SimpleResourceMock "name" was not populated');
        $this->assertEquals('Iron Man', $resource->getReference(), 'SimpleResourceMock "reference" was not populated');

    }

}
