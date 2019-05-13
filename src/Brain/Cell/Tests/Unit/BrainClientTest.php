<?php

declare(strict_types=1);

namespace Brain\Cell\Tests\Unit;

use Brain\Cell\BrainClient;
use Brain\Cell\Client\ClientConfiguration;
use Brain\Cell\Client\Delegate\Job\JobDelegateClient;
use Brain\Cell\Client\Delegate\StockDelegateClient;
use Brain\Cell\Client\RequestAdapterInterface;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @group cell
 * @group client
 *
 * @covers \Brain\Cell\BrainClient
 */
final class BrainClientTest extends TestCase
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
     *
     * @testdox Can return a delegate for stock.
     */
    public function stockReturnsDelegateClient(): void
    {
        $this->adapter->expects(self::never())->method('request');

        $client = new BrainClient($this->configuration);
        self::assertInstanceOf(StockDelegateClient::class, $client->stock());
    }

    /**
     * @test
     *
     * @testdox Can return a delegate for job.
     */
    public function jobReturnsDelegateClient(): void
    {
        $this->adapter->expects(self::never())->method('request');

        $client = new BrainClient($this->configuration);
        self::assertInstanceOf(JobDelegateClient::class, $client->job());
    }
}
