<?php

declare(strict_types=1);

namespace Brain\Cell\Tests\Unit\Client\RequestAdapter;

use Brain\Cell\Client\RequestAdapter\GuzzleHttpRequestAdapter;
use Brain\Cell\Client\RequestContext;
use Brain\Cell\Exception\Request\BadRequestException;
use Brain\Cell\Exception\Request\CommonClientErrorException;
use Brain\Cell\Exception\Request\NotFoundException;
use Brain\Cell\Exception\Request\PayloadViolationException;
use Brain\Cell\Exception\Request\UnknownRequestException;
use Brain\Cell\Response\ErrorMessageEnum;

use Symfony\Component\HttpFoundation\Request;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;
use Throwable;

/**
 * @group cell
 * @group client
 * @group client-adapter
 *
 * @covers \Brain\Cell\Client\RequestAdapter\GuzzleHttpRequestAdapter
 */
final class GuzzleHttpRequestAdapterTest extends TestCase
{
    public const BASE_PATH = 'https://some.example.com/v1';

    /** @var GuzzleClient|MockObject */
    protected $guzzle;

    /** @var GuzzleHttpRequestAdapter */
    protected $adapter;

    /** @var RequestContext */
    protected $context;

    /**
     * {@inheritdoc}
     */
    public function setUp(): void
    {
        /** @var MockObject|GuzzleClient $guzzle */
        $guzzle = $this->createMock(GuzzleClient::class);
        $this->guzzle = $guzzle;

        $this->adapter = new GuzzleHttpRequestAdapter($guzzle);
        $this->context = new RequestContext(self::BASE_PATH);
    }

    /**
     * @test
     * @testdox Adapter can understand success JSON responses
     */
    public function requestAdapterReturnsSuccessResponseDeserialisedArrayIsReturned(): void
    {
        $this->guzzle->expects(self::once())
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

        self::assertEquals(['hello' => 'world'], $response);
    }

    /**
     * @test
     * @testdox Adapter can serialise filters.
     */
    public function requestWithSuppliedFiltersRequestIsMadeWithFilters(): void
    {
        $this->guzzle->expects(self::once())
            ->method('request')
            ->with(
                Request::METHOD_GET,
                sprintf('%s/end-point?filter[foo]=bar', self::BASE_PATH)
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
        /** @var MockObject|UriInterface $uri */
        $uri = $this->createMock(UriInterface::class);
        $uri->expects(self::any())
            ->method('__toString')
            ->willReturn('/end-point');

        /** @var MockObject|StreamInterface $requestStream */
        $requestStream = $this->createMock(StreamInterface::class);
        $requestStream->expects(self::any())
            ->method('getContents')
            ->willReturn(json_encode(
                []
            ));

        /** @var MockObject|RequestInterface $guzzleRequest */
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

        /** @var MockObject|StreamInterface $responseStream */
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

        /** @var MockObject|ResponseInterface $guzzleResponse */
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
        /** @var MockObject|UriInterface $uri */
        $uri = $this->createMock(UriInterface::class);
        $uri->expects(self::any())
            ->method('__toString')
            ->willReturn('/end-point');

        /** @var MockObject|StreamInterface $requestStream */
        $requestStream = $this->createMock(StreamInterface::class);
        $requestStream->expects(self::any())
            ->method('getContents')
            ->willReturn(json_encode(
                []
            ));

        /** @var MockObject|RequestInterface $guzzleRequest */
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

        /** @var MockObject|StreamInterface $responseStream */
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

        /** @var MockObject|ResponseInterface $guzzleResponse */
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
        /** @var MockObject|UriInterface $uri */
        $uri = $this->createMock(UriInterface::class);
        $uri->expects(self::any())
            ->method('__toString')
            ->willReturn('/end-point');

        /** @var MockObject|StreamInterface $requestStream */
        $requestStream = $this->createMock(StreamInterface::class);
        $requestStream->expects(self::any())
            ->method('getContents')
            ->willReturn(json_encode(
                []
            ));

        /** @var MockObject|RequestInterface $guzzleRequest */
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

        /** @var MockObject|StreamInterface $responseStream */
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

        /** @var MockObject|ResponseInterface $guzzleResponse */
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
     */
    public function wrapsExceptionCommonClientError(): void
    {
        /** @var MockObject|UriInterface $uri */
        $uri = $this->createMock(UriInterface::class);
        $uri->expects(self::any())
            ->method('__toString')
            ->willReturn('/end-point');

        /** @var MockObject|StreamInterface $requestStream */
        $requestStream = $this->createMock(StreamInterface::class);
        $requestStream->expects(self::any())
            ->method('getContents')
            ->willReturn(json_encode(
                []
            ));

        /** @var MockObject|RequestInterface $guzzleRequest */
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

        /** @var MockObject|StreamInterface $responseStream */
        $responseStream = $this->createMock(StreamInterface::class);
        $responseStream->expects(self::any())
            ->method('getContents')
            ->willReturn(json_encode(
                [
                    'error' => [
                        'canonical' => ErrorMessageEnum::ERROR_COMMON_CLIENT_ERROR,
                        'message' => 'This is a user-displayable message example',
                    ],
                    'data' => [
                        'isMessageEndUserSafe' => true,
                    ],
                ]
            ));

        /** @var MockObject|ResponseInterface $guzzleResponse */
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

        try {
            $this->adapter->request($this->context);
        } catch (CommonClientErrorException $exception) {
            self::assertEquals('This is a user-displayable message example', $exception->getMessage());
            self::assertTrue($exception->isMessageEndUserSafe());
            self::assertNull($exception->getErrorCode());

            return;
        } catch (Throwable $exception) {
            self::fail(sprintf('Expected "%s" exception to have been thrown.', CommonClientErrorException::class));

            return;
        }

        self::fail(sprintf('Expected "%s" exception to have been thrown.', CommonClientErrorException::class));
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
        /** @var MockObject|UriInterface $uri */
        $uri = $this->createMock(UriInterface::class);
        $uri->expects(self::any())
            ->method('__toString')
            ->willReturn('/end-point');

        /** @var MockObject|StreamInterface $requestStream */
        $requestStream = $this->createMock(StreamInterface::class);
        $requestStream->expects(self::any())
            ->method('getContents')
            ->willReturn(json_encode(
                []
            ));

        /** @var MockObject|RequestInterface $guzzleRequest */
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

        /** @var MockObject|StreamInterface $responseStream */
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

        /** @var MockObject|ResponseInterface $guzzleResponse */
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
