<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\ClientResource;

class AuthenticationDelegateClient extends DelegateClient
{
    public function getMe()
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/whoami');

        return $this->request($context, new ClientResource());
    }
}
