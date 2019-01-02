<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\WhoAmIResponseResource;

class AuthenticationDelegateClient extends DelegateClient
{
    public function getMe(): WhoAmIResponseResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet('/whoami');

        return $this->request($context, new WhoAmIResponseResource());
    }
}
