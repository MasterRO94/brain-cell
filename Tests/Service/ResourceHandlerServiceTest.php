<?php

namespace Brain\Cell\Tests\Service;

use Brain\Cell\Service\ResourceHandlerService;
use Brain\Cell\Tests\BaseTestCase;
use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\EntityResourceFactory;
use Brain\Cell\TransformerDecoderInterface;
use Brain\Cell\TransformerEncoderInterface;

use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * @group cell
 * @group service
 */
class ResourceHandlerServiceTest extends BaseTestCase
{

    /** @var MockObject|EntityResourceFactory */
    protected $factoryMock;

    /** @var MockObject|TransformerEncoderInterface */
    protected $encoderMock;

    /** @var MockObject|TransformerDecoderInterface */
    protected $decoderMock;

    /** @var ResourceHandlerService */
    protected $service;

    /** @var SimpleResourceMock */
    protected $resource;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->resource = new SimpleResourceMock;

        $this->factoryMock = $this->getMock(EntityResourceFactory::CLASS);
        $this->encoderMock = $this->getMock(TransformerEncoderInterface::CLASS);
        $this->decoderMock = $this->getMock(TransformerDecoderInterface::CLASS);

        $this->service = new ResourceHandlerService(
            $this->factoryMock,
            $this->encoderMock,
            $this->decoderMock
        );

    }

    /**
     * @test
     */
    public function serviceEncoderDependency()
    {

        $this->encoderMock->expects($this->once())
            ->method('encode')
            ->willReturn('encoded');

        $response = $this->service->serialise($this->resource);
        $this->assertEquals('encoded', $response, 'Service is not returning the response from the TransformerEncoderInterface');

    }

    /**
     * @test
     */
    public function serviceDecoderDependency()
    {

        $this->decoderMock->expects($this->once())
            ->method('decode')
            ->willReturn($this->resource);

        $response = $this->service->deserialise($this->resource, []);
        $this->assertEquals($this->resource, $response, 'Service is not returning the response from the TransformerDecoderInterface');

    }

    /**
     * @test
     */
    public function serviceEntityFactoryDependency()
    {

        $this->factoryMock->expects($this->once())
            ->method('create')
            ->willReturn($this->resource);

        $response = $this->service->create('class', 1);
        $this->assertEquals($this->resource, $response, 'Service is not returning the response from the EntityFactory');

    }

}
