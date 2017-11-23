<?php

namespace Brain\Cell\Tests\Unit;

use Brain\Cell\BrainClient;
use Brain\Cell\Client\ClientConfiguration;
use Brain\Cell\Client\Delegate\JobDelegateClient;
use Brain\Cell\Client\Delegate\StockDelegateClient;
use Brain\Cell\Client\RequestAdapterInterface;
use Brain\Cell\Tests\AbstractBrainCellTestCase;

use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * @group cell
 * @group client
 */
class BrainClientTest extends AbstractBrainCellTestCase
{

    /** @var MockObject|RequestAdapterInterface */
    protected $adapter;

    /** @var ClientConfiguration */
    protected $configuration;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->adapter = $this->getMockForAbstractClass(RequestAdapterInterface::class);
        $this->configuration = new ClientConfiguration($this->adapter, 'some-key');
    }

    /**
     * @test
     * @testdox Can return a delegate for stock.
     */
    public function stock_returnsDelegateClient()
    {
        $this->adapter->expects($this->never())->method('request');

        $client = new BrainClient($this->configuration);
        $this->assertInstanceOf(StockDelegateClient::class, $client->stock());

    }

    /**
     * @test
     * @testdox Can return a delegate for job.
     */
    public function job_returnsDelegateClient()
    {
        $this->adapter->expects($this->never())->method('request');

        $client = new BrainClient($this->configuration);
        $this->assertInstanceOf(JobDelegateClient::class, $client->job());

    }

}
