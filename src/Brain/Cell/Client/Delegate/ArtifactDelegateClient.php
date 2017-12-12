<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Artifact\ArtifactResource;
use Brain\Cell\Transfer\AbstractResource;

class ArtifactDelegateClient extends DelegateClient
{
    /**
     * @param ArtifactResource $artifactResource
     * @return AbstractResource|ArtifactResource
     */
    public function createArtifact(ArtifactResource $artifactResource)
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/artifacts');
        $context->setPayload($handler->serialise($artifactResource));

        return $this->request($context, new ArtifactResource());
    }
}
