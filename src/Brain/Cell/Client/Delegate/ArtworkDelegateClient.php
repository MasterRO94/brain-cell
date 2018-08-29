<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Artwork\ArtworkIssueResource;
use Brain\Cell\EntityResource\File\FileResource;

use Psr\Http\Message\StreamInterface;

class ArtworkDelegateClient extends DelegateClient
{
    /**
     * @deprecated use downloadFile instead
     *
     * @param string $id
     *
     * @return StreamInterface
     */
    public function downloadArtwork($id)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/artworks/%s/download', $id));

        return $this->stream($context);
    }

    /**
     * @param string $id
     *
     * @return FileResource
     */
    public function getFile(string $id): FileResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/files/%s', $id));

        return $this->request($context, new FileResource());
    }

    /**
     * @param string $id
     *
     * @return StreamInterface
     */
    public function downloadFile(string $id): StreamInterface
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/files/%s/download', $id));

        return $this->stream($context);
    }

    /**
     * @param string $id
     * @param ArtworkIssueResource $issue
     *
     * @return ArtworkIssueResource
     */
    public function createArtworkIssue(string $id, ArtworkIssueResource $issue)
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost(sprintf('/artworks/%s/issues', $id));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($issue));

        return $this->request($context, new ArtworkIssueResource());
    }
}
