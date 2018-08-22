<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\WhoAmIResponseResource;

class AuthenticationDelegateClient extends DelegateClient
{
    /**
     * @return WhoAmIResponseResource
     */
    public function getMe(): WhoAmIResponseResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/whoami');

        return $this->request($context, new WhoAmIResponseResource());
    }
}
