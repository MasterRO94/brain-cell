<?php

namespace Brain\Cell;

use Brain\Cell\Client\Delegate\JobDelegateClient;
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

    /**
     * @return JobDelegateClient
     */
    public function job()
    {
        return new JobDelegateClient($this->configuration);
    }

}
