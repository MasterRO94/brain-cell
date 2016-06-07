<?php

namespace Brain\Cell;

use Brain\Cell\Client\Delegate\StockDelegateClient;
use Brain\Cell\Client\DelegateClient;

class BrainClient extends DelegateClient
{

    /**
     * @return StockDelegateClient
     */
    public function stock()
    {
        return new StockDelegateClient($this->configuration);
    }

}
