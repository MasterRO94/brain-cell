<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Artwork\ArtworkIssueResource;
use Brain\Cell\EntityResource\File\FileDownloadPathResourceInterface;
use Brain\Cell\EntityResource\File\FileResourceInterface;

use Psr\Http\Message\StreamInterface;

class ArtworkDelegateClient extends DelegateClient
{
    /**
     * @deprecated use use file()->download() instead.
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
     * @deprecated use file()->get() instead.
     *
     * @param string $id
     */
    public function getFile(string $id): FileResourceInterface
    {
        return (new FileDelegateClient($this->configuration))->get($id);
    }

    /**
     * @deprecated use file()->getDownloadPath() instead.
     *
     * @param string $id
     */
    public function getFileDownloadPath(string $id): FileDownloadPathResourceInterface
    {
        return (new FileDelegateClient($this->configuration))->getDownloadPath($id);
    }

    /**
     * @deprecated use file()->download() instead.
     *
     * @param string $id
     */
    public function downloadFile(string $id): StreamInterface
    {
        return (new FileDelegateClient($this->configuration))->download($id);
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
