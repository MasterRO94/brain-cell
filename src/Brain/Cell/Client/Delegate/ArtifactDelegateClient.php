<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Artifact\ArtifactResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\TransferEntityInterface;

class ArtifactDelegateClient extends DelegateClient
{
    /**
     * @param ArtifactResource $artifactResource
     * @return ArtifactResource|AbstractResource|TransferEntityInterface
     */
    public function createArtifact(ArtifactResource $artifactResource): ArtifactResource
    {
        $handler = $this->configuration->getResourceHandler();

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/artifacts');
        $context->setPayload($handler->serialise($artifactResource));

        return $this->request($context, new ArtifactResource());
    }
}
