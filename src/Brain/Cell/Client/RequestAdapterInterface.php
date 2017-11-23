<?php

namespace Brain\Cell\Client;

use Psr\Http\Message\StreamInterface;

interface RequestAdapterInterface
{
    /**
     * @param RequestContext $context
     *
     * @return array
     */
    public function request(RequestContext $context);

    /**
     * @param RequestContext $context
     *
     * @return StreamInterface
     */
    public function stream(RequestContext $context);
}
