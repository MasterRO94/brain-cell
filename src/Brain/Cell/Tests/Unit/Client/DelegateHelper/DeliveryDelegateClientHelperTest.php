<?php

declare(strict_types=1);

namespace Brain\Cell\Tests\Unit\Client\DelegateHelper;

use Brain\Cell\Client\Delegate\DeliveryDelegateClient;
use Brain\Cell\Client\DelegateHelper\DeliveryDelegateClientHelper;
use Brain\Cell\EntityResource\Delivery\DeliveryOptionResource;
use Brain\Cell\EntityResource\Delivery\GetDeliveryOptionsArgs;
use Brain\Cell\EntityResource\Delivery\GetDeliveryOptionsOptionsResource;
use Brain\Cell\Transfer\ResourceCollection;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use RuntimeException;

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
            ->expects(self::once())
            ->method('getDeliveryOptions')
            ->willReturn(new ResourceCollection([
                new DeliveryOptionResource(),
            ]));

        $helper = new DeliveryDelegateClientHelper($mockDeliveryDelegateClient);

        $result = $helper->getDeliveryOptionsOrFallbackDeliveryOption(new GetDeliveryOptionsArgs());

        self::assertEquals(1, $result->getDeliveryOptionsCollection()->count());
        self::assertNull($result->getNormalDeliveryOptionsCreationException());
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
            ->expects(self::any())
            ->method('getDeliveryOptions')
            ->will(self::returnCallback(static function (GetDeliveryOptionsArgs $args) {
                $isFallbackDeliveryOptionOnlyRequested = false;

                $argsOptions = $args->getOptions();
                if ($argsOptions instanceof GetDeliveryOptionsOptionsResource) {
                    /*
                     * Retrieve the option using reflection. I don't want to supply getters for them.
                     */
                    $argsOptionsReflectionClass = new ReflectionClass($argsOptions);
                    $argsOptionsFallbackOptionProperty = $argsOptionsReflectionClass->getProperty('fallbackDeliveryOptionOnly');
                    $argsOptionsFallbackOptionProperty->setAccessible(true);

                    $fallbackDeliveryOptionOnlyOption = $argsOptionsFallbackOptionProperty->getValue($argsOptions);

                    $isFallbackDeliveryOptionOnlyRequested = (bool) $fallbackDeliveryOptionOnlyOption;
                }

                if ($isFallbackDeliveryOptionOnlyRequested) {
                    return new ResourceCollection([
                        new DeliveryOptionResource(),
                    ]);
                }

                throw new RuntimeException('Mock exception to represent normal delivery options retrieval failure. It should be caught and gracefully handled.');
            }));

        $helper = new DeliveryDelegateClientHelper($mockDeliveryDelegateClient);

        $result = $helper->getDeliveryOptionsOrFallbackDeliveryOption(new GetDeliveryOptionsArgs());

        self::assertEquals(1, $result->getDeliveryOptionsCollection()->count());
        self::assertNotNull($result->getNormalDeliveryOptionsCreationException());
    }
}
