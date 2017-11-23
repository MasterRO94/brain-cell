<?php

namespace Brain\Cell\Tests\Unit\Client;

use Brain\Cell\Client\ClientConfiguration;
use Brain\Cell\Client\Delegate\JobDelegateClient;
use Brain\Cell\Client\Delegate\StockDelegateClient;
use Brain\Cell\Client\RequestAdapterInterface;
use Brain\Cell\Client\RequestContext;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\EntityResource\Stock\FinishingCategoryResource;
use Brain\Cell\EntityResource\StockFinishingsResource;
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
                    'finishings' => [
                        [
                            'id' => 'some-id',
                            'alias' => 'some-alias',
                            'name' => 'some-name',
                            'options' => []
                        ]
                    ],
                    'materials' => [],
                    'sizes' => []
                ]
            );

        $resourceHandler = $this->getResourceHandler();
        $this->configuration->setResourceHandler($resourceHandler);

        $delegate = new StockDelegateClient($this->configuration);
        $resource = $delegate->getFinishings(new JobResource());

        $this->assertInstanceOf(StockFinishingsResource::class, $resource);

    }

    /**
     * @test
     * @testdox Delegate can send post requests.
     */
    public function request_whenRequestingWithPost_sendsPayload()
    {
        $this->adapter->expects($this->once())
            ->method('request')
            ->with(
                $this->callback(function (RequestContext $context) {
                    $payload = $context->getPayload();

                    //  Payload should be an array ..
                    if (!is_array($payload)) {
                        return false;
                    }

                    //  .. with resource keys at the root ..
                    if (!isset($payload['quantity'])) {
                        return false;
                    }

                    //  .. and values as set.
                    return ($payload['quantity'] === 42);

                })
            )
            ->willReturn(['status' => true])
        ;

        $job = new JobResource;
        $job->setQuantity(42);

        $resourceHandler = $this->getResourceHandler();
        $this->configuration->setResourceHandler($resourceHandler);

        $delegate = new JobDelegateClient($this->configuration);
        $delegate->postJob($job);
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
