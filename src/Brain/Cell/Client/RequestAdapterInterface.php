<?php

declare(strict_types=1);

namespace Brain\Cell\Client;

use Psr\Http\Message\StreamInterface;

interface RequestAdapterInterface
{
    /**
     * @return mixed[]
     */
    public function request(RequestContext $context): array;

    public function stream(RequestContext $context): StreamInterface;
}
