<?php

namespace Brain\Cell\Tests\Client;

use Brain\Cell\Client\ClientConfiguration;
use Brain\Cell\Client\Delegate\StockDelegateClient;
use Brain\Cell\Client\RequestAdapterInterface;
use Brain\Cell\EntityResource\Stock\OptionCategoryResource;
use Brain\Cell\Service\ResourceHandlerService;
use Brain\Cell\Service\TransferEntityMetaManagerService;
use Brain\Cell\Tests\AbstractBrainCellTestCase;
use Brain\Cell\Transfer\EntityResourceFactory;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\Transformer\ArrayDecoder;
use Brain\Cell\Transformer\ArrayEncoder;

use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * @group cell
 * @group client
 */
class DelegateClientTest extends AbstractBrainCellTestCase
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
     * @testdox Delegate hydrates resources as objects if there is a resource handler configured
     */
    public function request_whenRequestingWithResourceHandler_returnsHydratedResources()
    {

        $this->adapter->expects($this->once())
            ->method('request')
            ->willReturn(
                [
                    'data' => [
                        [
                            'id' => 'some-id',
                            'alias' => 'some-alias',
                            'name' => 'some-name',
                            'options' => [
                                'data' => []
                            ]
                        ]
                    ]
                ]
            );

        $resourceHandler = $this->getResourceHandler();
        $this->configuration->setResourceHandler($resourceHandler);

        $delegate = new StockDelegateClient($this->configuration);
        $collection = $delegate->getOptions();

        $this->assertInstanceOf(ResourceCollection::class, $collection);
        $this->assertEquals(1, $collection->count());

        /** @var OptionCategoryResource $resource */
        $resource = $collection->first();

        $this->assertInstanceOf(OptionCategoryResource::class, $resource);
        $this->assertEquals('some-id', $resource->getId());

    }

    /**
     * @return ResourceHandlerService
     */
    protected function getResourceHandler()
    {
        $metaManager = new TransferEntityMetaManagerService;

        return new ResourceHandlerService(
            new EntityResourceFactory,
            new ArrayEncoder($metaManager),
            new ArrayDecoder($metaManager)
        );

    }

}
