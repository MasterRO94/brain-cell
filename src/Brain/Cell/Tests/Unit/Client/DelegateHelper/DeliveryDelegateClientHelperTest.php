<?php

declare(strict_types=1);

namespace Brain\Cell\Tests\Unit\Client\DelegateHelper;

use Brain\Cell\Client\Delegate\DeliveryDelegateClient;
use Brain\Cell\Client\DelegateHelper\DeliveryDelegateClientHelper;
use Brain\Cell\EntityResource\Delivery\DeliveryGetDeliveryOptionsActionArgs;
use Brain\Cell\EntityResource\Delivery\DeliveryOptionResource;
use Brain\Cell\Transfer\ResourceCollection;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @group cell
 * @group client
 */
final class DeliveryDelegateClientHelperTest extends TestCase
{
    /**
     * @test
     */
    public function getDeliveryOptionsOrFallbackDeliveryOptionReturnsNormalDeliveryOptions(): void
    {
        /** @var DeliveryDelegateClient|MockObject $mockDeliveryDelegateClient */
        $mockDeliveryDelegateClient = $this->getMockBuilder(DeliveryDelegateClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockDeliveryDelegateClient
            ->expects($this->once())
            ->method('getDeliveryOptions')
            ->willReturn(new ResourceCollection([
                new DeliveryOptionResource(),
            ]));

        $helper = new DeliveryDelegateClientHelper($mockDeliveryDelegateClient);

        $result = $helper->getDeliveryOptionsOrFallbackDeliveryOption(new DeliveryGetDeliveryOptionsActionArgs());

        $this->assertEquals(1, $result->getDeliveryOptionsCollection()->count());
        $this->assertNull($result->getNormalDeliveryOptionsCreationException());
    }

    /**
     * @test
     */
    public function getDeliveryOptionsOrFallbackDeliveryOptionReturnsFallbackDeliveryOptionsOnError(): void
    {
        /** @var DeliveryDelegateClient|MockObject $mockDeliveryDelegateClient */
        $mockDeliveryDelegateClient = $this->getMockBuilder(DeliveryDelegateClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockDeliveryDelegateClient
            ->expects($this->any())
            ->method('getDeliveryOptions')
            ->will($this->returnCallback(function (DeliveryGetDeliveryOptionsActionArgs $args) {
                /*
                 * Retrieve the args' options using reflection. I don't want to supply getters for them.
                 */
                $argsReflectionClass = new \ReflectionClass($args);
                $argsOptionsProperty = $argsReflectionClass->getProperty('options');
                $argsOptionsProperty->setAccessible(true);
                $argsOptionsValue = $argsOptionsProperty->getValue($args);

                $isFallbackDeliveryOptionOnlyRequested = $argsOptionsValue['fallback_delivery_option_only'] ?? false;

                if ($isFallbackDeliveryOptionOnlyRequested) {
                    return new ResourceCollection([
                        new DeliveryOptionResource(),
                    ]);
                }

                throw new \RuntimeException('Mock exception to represent normal delivery options retrieval failure. It should be caught and gracefully handled.');
            }));

        $helper = new DeliveryDelegateClientHelper($mockDeliveryDelegateClient);

        $result = $helper->getDeliveryOptionsOrFallbackDeliveryOption(new DeliveryGetDeliveryOptionsActionArgs());

        $this->assertEquals(1, $result->getDeliveryOptionsCollection()->count());
        $this->assertNotNull($result->getNormalDeliveryOptionsCreationException());
    }
}
