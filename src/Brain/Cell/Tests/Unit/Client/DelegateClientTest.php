<?php

declare(strict_types=1);

namespace Brain\Cell\Tests\Unit\Client;

use Brain\Cell\Client\ClientConfiguration;
use Brain\Cell\Client\Delegate\Job\JobDelegateClient;
use Brain\Cell\Client\Delegate\StockDelegateClient;
use Brain\Cell\Client\RequestAdapterInterface;
use Brain\Cell\Client\RequestContext;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\Service\ResourceHandlerService;
use Brain\Cell\Transfer\EntityResourceFactory;
use Brain\Cell\Transformer\ArrayDecoder;
use Brain\Cell\Transformer\ArrayEncoder;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @group cell
 * @group client
 */
final class DelegateClientTest extends TestCase
{
    /** @var MockObject|RequestAdapterInterface */
    protected $adapter;

    /** @var ClientConfiguration */
    protected $configuration;

    /**
     * {@inheritdoc}
     */
    public function setUp(): void
    {
        /** @var RequestAdapterInterface|MockObject $adapter */
        $adapter = $this->createMock(RequestAdapterInterface::class);
        $this->adapter = $adapter;

        $this->configuration = new ClientConfiguration($adapter, 'some-key');
    }

    /**
     * @test
     * @testdox Delegate hydrates resources as objects if there is a resource handler configured
     */
    public function requestWhenRequestingWithResourceHandlerReturnsHydratedResources(): void
    {
        $this->adapter->expects(self::once())
            ->method('request')
            ->willReturn(
                [
                    'finishings' => [
                        [
                            'id' => 'some-id',
                            'alias' => 'some-alias',
                            'name' => 'some-name',
                            'options' => [],
                        ],
                    ],
                    'materials' => [],
                    'sizes' => [],
                ]
            );

        $delegate = new StockDelegateClient($this->configuration, $this->getResourceHandler());
        $resource = $delegate->getFinishings(new JobResource());

        self::assertEquals(1, $resource->getFinishings()->count());
    }

    /**
     * @test
     * @testdox Delegate can send post requests.
     */
    public function requestWhenRequestingWithPostSendsPayload(): void
    {
        $this->adapter->expects(self::once())
            ->method('request')
            ->with(
                self::callback(static function (RequestContext $context) {
                    $payload = $context->getPayload();

                    // .. with resource keys at the root ..
                    if (!isset($payload['quantity'])) {
                        return false;
                    }

                    // .. and values as set.
                    return $payload['quantity'] === 42;
                })
            )
            ->willReturn(['status' => true]);

        $job = new JobResource();
        $job->setQuantity(42);

        $delegate = new JobDelegateClient($this->configuration, $this->getResourceHandler());
        $delegate->postJob($job);
    }

    protected function getResourceHandler(): ResourceHandlerService
    {
        return new ResourceHandlerService(
            new EntityResourceFactory(),
            new ArrayEncoder(),
            new ArrayDecoder()
        );
    }
}
