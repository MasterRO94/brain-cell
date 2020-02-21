<?php

declare(strict_types=1);

namespace Brain\Cell\Client\DelegateHelper;

use Brain\Cell\Client\Delegate\DeliveryDelegateClient;
use Brain\Cell\EntityResource\Delivery\DeliveryGetDeliveryOptionsActionArgs;
use Brain\Cell\Logical\Delivery\GetDeliveryOptionsOrFallbackDeliveryOptionResult;

use Exception;
use Throwable;

class DeliveryDelegateClientHelper
{
    /** @var DeliveryDelegateClient */
    private $deliveryDelegateClient;

    public function __construct(DeliveryDelegateClient $deliveryDelegateClient)
    {
        $this->deliveryDelegateClient = $deliveryDelegateClient;
    }

    /**
     * @param mixed[] $options
     */
    public function getDeliveryOptionsOrFallbackDeliveryOption(
        DeliveryGetDeliveryOptionsActionArgs $actionArgs,
        array $options = []
    ): GetDeliveryOptionsOrFallbackDeliveryOptionResult {
        $options = array_merge([
            /*
             * The http request's timeout when attempting to obtain normal delivery options.
             */
            'normalDeliveryOptionsCreationTimeoutSeconds' => null,
        ], $options);

        /** @var Exception|null $normalDeliveryOptionsCreationException */
        $normalDeliveryOptionsCreationException = null;

        try {
            $deliveryOptionsCollection = $this->deliveryDelegateClient->getDeliveryOptions(
                $actionArgs,
                [
                    'requestTimeoutSeconds' => $options['normalDeliveryOptionsCreationTimeoutSeconds'],
                ]
            );
        } catch (Throwable $exception) {
            $normalDeliveryOptionsCreationException = $exception;
            $actionArgs->setOptionFallbackDeliveryOptionOnly(true);

            $deliveryOptionsCollection = $this->deliveryDelegateClient->getDeliveryOptions($actionArgs);
        }

        return new GetDeliveryOptionsOrFallbackDeliveryOptionResult(
            $deliveryOptionsCollection,
            $normalDeliveryOptionsCreationException
        );
    }
}
