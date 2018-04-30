<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\JobQueryResource;

class JobQueryDelegateClient extends DelegateClient
{
    /**
     * @param string $id
     *
     * @return JobQueryResource
     */
    public function getQuery($id)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/queries/%s', $id));

        return $this->request($context, new JobQueryResource());
    }
}
