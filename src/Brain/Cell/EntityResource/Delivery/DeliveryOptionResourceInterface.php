<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\EntityResource\Country\AddressResourceInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\TransferEntityInterface;

/**
 * A delivery option resource.
 */
interface DeliveryOptionResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface
{
    public function getDeliveryAddress(): AddressResourceInterface;
}
