<?php

namespace Brain\Cell\Tests\Service;

use Brain\Cell\Service\ResourceHandlerService;
use Brain\Cell\Tests\BaseTestCase;
use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\EntityResourceFactory;
use Brain\Cell\Transformer\ArrayDecoder;
use Brain\Cell\Transformer\ArrayEncoder;

use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * @group cell
 * @group service
 */
class ResourceHandlerServiceTest extends BaseTestCase
{

    /** @var MockObject|EntityResourceFactory */
    protected $factoryMock;

    /** @var MockObject|ArrayEncoder */
    protected $encoderMock;

    /** @var MockObject|ArrayDecoder */
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

        $builder = $this->getMockBuilder(ArrayEncoder::CLASS);
        $builder->disableOriginalConstructor();
        $this->encoderMock = $builder->getMock();

        $builder = $this->getMockBuilder(ArrayDecoder::CLASS);
        $builder->disableOriginalConstructor();
        $this->decoderMock = $builder->getMock();

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
