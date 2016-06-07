<?php

namespace Brain\Cell\Tests\Client\RequestAdapter;

use Brain\Cell\Client\RequestAdapter\GuzzleHttpRequestAdapter;
use Brain\Cell\Client\RequestContext;
use Brain\Cell\Tests\AbstractBrainCellTestCase;

use Symfony\Component\HttpFoundation\Request;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * @group cell
 * @group client
 * @group client-adapter
 */
class GuzzleHttpRequestAdapterTest extends AbstractBrainCellTestCase
{

    const BASE_PATH = 'https://some.example.com/api';

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
        $this->guzzle = $this->getMock(GuzzleClient::class);
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

}
