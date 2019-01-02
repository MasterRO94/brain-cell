<?php

declare(strict_types=1);

namespace Brain\Cell\Tests\Unit\Service;

use Brain\Cell\Service\ResourceHandlerService;
use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\EntityResourceFactory;
use Brain\Cell\Transformer\ArrayDecoder;
use Brain\Cell\Transformer\ArrayEncoder;

use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * @group cell
 * @group service
 *
 * @covers \Brain\Cell\Service\ResourceHandlerService
 */
final class ResourceHandlerServiceTest extends TestCase
{
    /** @var EntityResourceFactory|MockObject */
    protected $factoryMock;

    /** @var ArrayEncoder|MockObject */
    protected $encoderMock;

    /** @var ArrayDecoder|MockObject */
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
        $this->resource = new SimpleResourceMock();

        $this->factoryMock = $this->createMock(EntityResourceFactory::class);

        $builder = $this->getMockBuilder(ArrayEncoder::class);
        $builder->disableOriginalConstructor();
        $this->encoderMock = $builder->getMock();

        $builder = $this->getMockBuilder(ArrayDecoder::class);
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
    public function serviceEncoderDependency(): void
    {
        $data = [
            'encoded' => true,
        ];

        $this->encoderMock->expects($this->once())
            ->method('encode')
            ->willReturn($data);

        $response = $this->service->serialise($this->resource);

        $this->assertEquals($data, $response, 'Service is not returning the response from the TransformerEncoderInterface');
    }

    /**
     * @test
     */
    public function serviceDecoderDependency(): void
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
    public function serviceEntityFactoryDependency(): void
    {
        $this->factoryMock->expects($this->once())
            ->method('create')
            ->willReturn($this->resource);

        $response = $this->service->create('class', 1);
        $this->assertEquals($this->resource, $response, 'Service is not returning the response from the EntityFactory');
    }
}
