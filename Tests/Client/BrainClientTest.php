<?php

namespace Brain\Cell\Tests\Client;

use Brain\Cell\BrainClient;
use Brain\Cell\Client\ClientConfiguration;
use Brain\Cell\Client\DelegateClient;
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
     * @testdox Logical modules of code are represented with delegate clients
     */
    public function stock_returnsDelegateClient()
    {

        $this->adapter->expects($this->never())
            ->method('request');

        $client = new BrainClient($this->configuration);

        $delegate = $client->stock();

        $this->assertInstanceOf(DelegateClient::class, $delegate);

    }

}
