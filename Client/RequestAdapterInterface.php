<?php

namespace Brain\Cell\Client;

interface RequestAdapterInterface
{
    
    public function request(RequestContext $context);

    public function stream(RequestContext $context);

}
