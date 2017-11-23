<?php

namespace Brain\Cell\Tests\Unit\Client\RequestAdapter;

use Brain\Cell\Client\RequestAdapter\GuzzleHttpRequestAdapter;
use Brain\Cell\Client\RequestContext;
use Brain\Cell\Exception\Request\BadRequestException;
use Brain\Cell\Exception\Request\NotFoundException;
use Brain\Cell\Exception\Request\PayloadViolationException;
use Brain\Cell\Exception\Request\UnknownRequestException;
use Brain\Cell\Response\ErrorMessageEnum;
use Brain\Cell\Tests\AbstractBrainCellTestCase;

use Symfony\Component\HttpFoundation\Request;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

/**
 * @group cell
 * @group client
 * @group client-adapter
 */
class GuzzleHttpRequestAdapterTest extends AbstractBrainCellTestCase
{
    const BASE_PATH = 'https://some.example.com/v1';

    /** @var MockObject|GuzzleClient */
    protected $guzzle;

    /** @var GuzzleHttpRequestAdapter */
    protected $adapter;

    /** @var RequestContext */
    protected $context;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->guzzle = $this->createMock(GuzzleClient::class);
        $this->adapter = new GuzzleHttpRequestAdapter($this->guzzle);
        $this->context = new RequestContext(self::BASE_PATH);
    }

    /**
     * @test
     * @testdox Adapter can understand success JSON responses
     */
    public function request_adapterReturnsSuccessResponse_deserialisedArrayIsReturned()
    {
        $this->guzzle->expects($this->once())
            ->method('request')
            ->with(
                Request::METHOD_GET,
                sprintf('%s/end-point', self::BASE_PATH)
            )
            ->willReturn(
                new Response(
                    200,
                    [],
                    '{"hello":"world"}'
                )
            );

        $this->context->prepareContextForGet('/end-point');
        $response = $this->adapter->request($this->context);

        $this->assertInternalType('array', $response);
        $this->assertEquals(['hello' => 'world'], $response);
    }

    /**
     * @test
     * @testdox Adapter can serialise filters.
     */
    public function request_withSuppliedFilters_requestIsMadeWithFilters()
    {
        $this->guzzle->expects($this->once())
            ->method('request')
            ->with(
                Request::METHOD_GET,
                sprintf('%s/end-point?filters[foo]=bar', self::BASE_PATH)
            )
            ->willReturn(
                new Response(
                    200,
                    [],
                    '{"hello":"world"}'
                )
            );

        $this->context->prepareContextForGet('/end-point');
        $this->context->getFilters()->set('foo', 'bar');

        $this->adapter->request($this->context);
    }

    /**
     * @test
     *
     * @group unit
     * @group client
     * @group client-adapter
     *
     * @covers \Brain\Cell\Client\RequestAdapter\GuzzleHttpRequestAdapter
     */
    public function wrapsExceptionPayloadViolation(): void
    {
        /** @var UriInterface|MockObject $uri */
        $uri = $this->createMock(UriInterface::class);
        $uri->expects(self::any())
            ->method('__toString')
            ->willReturn('/end-point');

        /** @var StreamInterface|MockObject $requestStream */
        $requestStream = $this->createMock(StreamInterface::class);
        $requestStream->expects(self::any())
            ->method('getContents')
            ->willReturn(json_encode(
                []
            ));

        /** @var RequestInterface|MockObject $guzzleRequest */
        $guzzleRequest = $this->createMock(RequestInterface::class);
        $guzzleRequest->expects(self::any())
            ->method('getUri')
            ->willReturn($uri);

        $guzzleRequest->expects(self::any())
            ->method('getBody')
            ->willReturn($requestStream);

        $guzzleRequest->expects(self::any())
            ->method('getMethod')
            ->willReturn('POST');

        /** @var StreamInterface|MockObject $responseStream */
        $responseStream = $this->createMock(StreamInterface::class);
        $responseStream->expects(self::any())
            ->method('getContents')
            ->willReturn(json_encode(
                [
                    'error' => [
                        'canonical' => ErrorMessageEnum::ERROR_PAYLOAD_VIOLATION,
                    ],
                    'violations' => [
                        'tony' => 'stark',
                    ],
                ]
            ));

        /** @var ResponseInterface|MockObject $guzzleResponse */
        $guzzleResponse = $this->createMock(ResponseInterface::class);
        $guzzleResponse->expects(self::any())
            ->method('getBody')
            ->willReturn($responseStream);

        $guzzleResponse->expects(self::any())
            ->method('getStatusCode')
            ->willReturn(400);

        $this->guzzle->expects(self::once())
            ->method('request')
            ->with()
            ->willThrowException(
                new ClientException(
                    'guzzle-errokr-message',
                    $guzzleRequest,
                    $guzzleResponse
                )
            );

        $this->context->prepareContextForPost('/end-point');

        self::expectException(PayloadViolationException::class);
        self::expectExceptionMessage('POST /end-point: {"tony":"stark"}');

        $this->adapter->request($this->context);
    }

    /**
     * @test
     *
     * @group unit
     * @group client
     * @group client-adapter
     *
     * @covers \Brain\Cell\Client\RequestAdapter\GuzzleHttpRequestAdapter
     */
    public function wrapsExceptionBadRequest(): void
    {
        /** @var UriInterface|MockObject $uri */
        $uri = $this->createMock(UriInterface::class);
        $uri->expects(self::any())
            ->method('__toString')
            ->willReturn('/end-point');

        /** @var StreamInterface|MockObject $requestStream */
        $requestStream = $this->createMock(StreamInterface::class);
        $requestStream->expects(self::any())
            ->method('getContents')
            ->willReturn(json_encode(
                []
            ));

        /** @var RequestInterface|MockObject $guzzleRequest */
        $guzzleRequest = $this->createMock(RequestInterface::class);
        $guzzleRequest->expects(self::any())
            ->method('getUri')
            ->willReturn($uri);

        $guzzleRequest->expects(self::any())
            ->method('getBody')
            ->willReturn($requestStream);

        $guzzleRequest->expects(self::any())
            ->method('getMethod')
            ->willReturn('POST');

        /** @var StreamInterface|MockObject $responseStream */
        $responseStream = $this->createMock(StreamInterface::class);
        $responseStream->expects(self::any())
            ->method('getContents')
            ->willReturn(json_encode(
                [
                    'error' => [
                        'canonical' => 'random',
                    ],
                ]
            ));

        /** @var ResponseInterface|MockObject $guzzleResponse */
        $guzzleResponse = $this->createMock(ResponseInterface::class);
        $guzzleResponse->expects(self::any())
            ->method('getBody')
            ->willReturn($responseStream);

        $guzzleResponse->expects(self::any())
            ->method('getStatusCode')
            ->willReturn(400);

        $this->guzzle->expects(self::once())
            ->method('request')
            ->with()
            ->willThrowException(
                new ClientException(
                    'guzzle-error-message',
                    $guzzleRequest,
                    $guzzleResponse
                )
            );

        $this->context->prepareContextForPost('/end-point');

        self::expectException(BadRequestException::class);
        self::expectExceptionMessage('POST /end-point: {"error":{"canonical":"random"}}');

        $this->adapter->request($this->context);
    }

    /**
     * @test
     *
     * @group unit
     * @group client
     * @group client-adapter
     *
     * @covers \Brain\Cell\Client\RequestAdapter\GuzzleHttpRequestAdapter
     */
    public function wrapsExceptionNotFound(): void
    {
        /** @var UriInterface|MockObject $uri */
        $uri = $this->createMock(UriInterface::class);
        $uri->expects(self::any())
            ->method('__toString')
            ->willReturn('/end-point');

        /** @var StreamInterface|MockObject $requestStream */
        $requestStream = $this->createMock(StreamInterface::class);
        $requestStream->expects(self::any())
            ->method('getContents')
            ->willReturn(json_encode(
                []
            ));

        /** @var RequestInterface|MockObject $guzzleRequest */
        $guzzleRequest = $this->createMock(RequestInterface::class);
        $guzzleRequest->expects(self::any())
            ->method('getUri')
            ->willReturn($uri);

        $guzzleRequest->expects(self::any())
            ->method('getBody')
            ->willReturn($requestStream);

        $guzzleRequest->expects(self::any())
            ->method('getMethod')
            ->willReturn('POST');

        /** @var StreamInterface|MockObject $responseStream */
        $responseStream = $this->createMock(StreamInterface::class);
        $responseStream->expects(self::any())
            ->method('getContents')
            ->willReturn(json_encode(
                [
                    'error' => [
                        'canonical' => 'random',
                    ],
                ]
            ));

        /** @var ResponseInterface|MockObject $guzzleResponse */
        $guzzleResponse = $this->createMock(ResponseInterface::class);
        $guzzleResponse->expects(self::any())
            ->method('getBody')
            ->willReturn($responseStream);

        $guzzleResponse->expects(self::any())
            ->method('getStatusCode')
            ->willReturn(404);

        $this->guzzle->expects(self::once())
            ->method('request')
            ->with()
            ->willThrowException(
                new ClientException(
                    'guzzle-error-message',
                    $guzzleRequest,
                    $guzzleResponse
                )
            );

        $this->context->prepareContextForPost('/end-point');

        self::expectException(NotFoundException::class);
        self::expectExceptionMessage('POST /end-point');

        $this->adapter->request($this->context);
    }

    /**
     * @test
     *
     * @group unit
     * @group client
     * @group client-adapter
     *
     * @covers \Brain\Cell\Client\RequestAdapter\GuzzleHttpRequestAdapter
     */
    public function wrapsGenericException(): void
    {
        /** @var UriInterface|MockObject $uri */
        $uri = $this->createMock(UriInterface::class);
        $uri->expects(self::any())
            ->method('__toString')
            ->willReturn('/end-point');

        /** @var StreamInterface|MockObject $requestStream */
        $requestStream = $this->createMock(StreamInterface::class);
        $requestStream->expects(self::any())
            ->method('getContents')
            ->willReturn(json_encode(
                []
            ));

        /** @var RequestInterface|MockObject $guzzleRequest */
        $guzzleRequest = $this->createMock(RequestInterface::class);
        $guzzleRequest->expects(self::any())
            ->method('getUri')
            ->willReturn($uri);

        $guzzleRequest->expects(self::any())
            ->method('getBody')
            ->willReturn($requestStream);

        $guzzleRequest->expects(self::any())
            ->method('getMethod')
            ->willReturn('POST');

        /** @var StreamInterface|MockObject $responseStream */
        $responseStream = $this->createMock(StreamInterface::class);
        $responseStream->expects(self::any())
            ->method('getContents')
            ->willReturn(json_encode(
                [
                    'error' => [
                        'canonical' => 'random',
                    ],
                ]
            ));

        /** @var ResponseInterface|MockObject $guzzleResponse */
        $guzzleResponse = $this->createMock(ResponseInterface::class);
        $guzzleResponse->expects(self::any())
            ->method('getBody')
            ->willReturn($responseStream);

        $guzzleResponse->expects(self::any())
            ->method('getStatusCode')
            ->willReturn(499);

        $this->guzzle->expects(self::once())
            ->method('request')
            ->with()
            ->willThrowException(
                new ClientException(
                    'guzzle-error-message',
                    $guzzleRequest,
                    $guzzleResponse
                )
            );

        $this->context->prepareContextForPost('/end-point');

        self::expectException(UnknownRequestException::class);
        self::expectExceptionMessage('POST /end-point: {"error":{"canonical":"random"}}');

        $this->adapter->request($this->context);
    }
}
