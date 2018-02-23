<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Artifact\ArtifactResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\TransferEntityInterface;

use Psr\Http\Message\StreamInterface;

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

    /**
     * @param string $id
     *
     * @return StreamInterface
     */
    public function downloadArtifact($id)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/artifacts/%s/download', $id));

        return $this->stream($context);
    }
}
