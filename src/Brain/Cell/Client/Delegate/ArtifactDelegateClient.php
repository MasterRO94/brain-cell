<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Artifact\ArtifactResource;
use Brain\Cell\EntityResource\Resource\PresignedAssetResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\TransferEntityInterface;

use Psr\Http\Message\StreamInterface;

class ArtifactDelegateClient extends DelegateClient
{
    /**
     * @return AbstractResource|ArtifactResource|TransferEntityInterface
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
     * @return AbstractResource|PresignedAssetResource|TransferEntityInterface
     */
    public function getPresignedAsset(): PresignedAssetResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost('/presigned-assets');

        return $this->request($context, new PresignedAssetResource());
    }

    public function downloadArtifact(string $id): StreamInterface
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/artifacts/%s/download', $id));

        return $this->stream($context);
    }
}
