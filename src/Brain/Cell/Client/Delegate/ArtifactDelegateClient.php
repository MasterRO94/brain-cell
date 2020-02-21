<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Artifact\ArtifactResource;
use Brain\Cell\EntityResource\Resource\PresignedAssetResource;

use Psr\Http\Message\StreamInterface;

class ArtifactDelegateClient extends DelegateClient
{
    public function createArtifact(ArtifactResource $artifactResource): ArtifactResource
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost('/artifacts');
        $context->setPayload($this->resourceHandler->serialise($artifactResource));

        /** @var ArtifactResource $resource */
        $resource = $this->request($context, new ArtifactResource());

        return $resource;
    }

    public function getPresignedAsset(): PresignedAssetResource
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost('/presigned-assets');

        /** @var PresignedAssetResource $resource */
        $resource = $this->request($context, new PresignedAssetResource());

        return $resource;
    }

    public function downloadArtifact(string $id): StreamInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet(sprintf('/artifacts/%s/download', $id));

        return $this->stream($context);
    }
}
