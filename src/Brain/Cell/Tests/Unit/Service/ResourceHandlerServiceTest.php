<?php

declare(strict_types=1);

namespace Brain\Cell\Tests\Unit\Service;

use Brain\Cell\Service\ResourceHandlerService;
use Brain\Cell\Tests\Mock\SimpleResourceMock;
use Brain\Cell\Transfer\EntityResourceFactory;
use Brain\Cell\Transformer\ArrayDecoder;
use Brain\Cell\Transformer\ArrayEncoder;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @group cell
 * @group service
 *
 * @covers \Brain\Cell\Service\ResourceHandlerService
 */
final class ResourceHandlerServiceTest extends TestCase
{
    /** @var EntityResourceFactory|MockObject */
    protected $factory;

    /** @var ArrayEncoder|MockObject */
    protected $encoder;

    /** @var ArrayDecoder|MockObject */
    protected $decoder;

    /** @var ResourceHandlerService */
    protected $handler;

    /** @var SimpleResourceMock */
    protected $resource;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->resource = new SimpleResourceMock();

        /** @var EntityResourceFactory|MockObject $factory */
        $factory = $this->createMock(EntityResourceFactory::class);
        $this->factory = $factory;

        $builder = $this->getMockBuilder(ArrayEncoder::class);
        $builder->disableOriginalConstructor();

        /** @var ArrayEncoder|MockObject $encoder */
        $encoder = $builder->getMock();
        $this->encoder = $encoder;

        $builder = $this->getMockBuilder(ArrayDecoder::class);
        $builder->disableOriginalConstructor();

        /** @var ArrayDecoder|MockObject $decoder */
        $decoder = $builder->getMock();
        $this->decoder = $decoder;

        $this->handler = new ResourceHandlerService($factory, $encoder, $decoder);
    }

    /**
     * @test
     */
    public function serviceEncoderDependency(): void
    {
        $data = [
            'encoded' => true,
        ];

        $this->encoder->expects($this->once())
            ->method('encode')
            ->willReturn($data);

        $response = $this->handler->serialise($this->resource);

        $this->assertEquals($data, $response, 'Service is not returning the response from the TransformerEncoderInterface');
    }

    /**
     * @test
     */
    public function serviceDecoderDependency(): void
    {
        $this->decoder->expects($this->once())
            ->method('decode')
            ->willReturn($this->resource);

        $response = $this->handler->deserialise($this->resource, []);
        $this->assertEquals($this->resource, $response, 'Service is not returning the response from the TransformerDecoderInterface');
    }

    /**
     * @test
     */
    public function serviceEntityFactoryDependency(): void
    {
        $this->factory->expects($this->once())
            ->method('create')
            ->willReturn($this->resource);

        $response = $this->handler->create('class', '1');
        $this->assertEquals($this->resource, $response, 'Service is not returning the response from the EntityFactory');
    }
}
