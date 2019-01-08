<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\Delegate\File\FileDelegateClient;
use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Artwork\ArtworkIssueResource;
use Brain\Cell\EntityResource\File\FileDownloadPathResourceInterface;
use Brain\Cell\EntityResource\File\FileResourceInterface;

use Psr\Http\Message\StreamInterface;

class ArtworkDelegateClient extends DelegateClient
{
    /**
     * @deprecated use use file()->download() instead.
     */
    public function downloadArtwork(string $id): StreamInterface
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/artworks/%s/download', $id));

        return $this->stream($context);
    }

    /**
     * @deprecated use file()->get() instead.
     */
    public function getFile(string $id): FileResourceInterface
    {
        return (new FileDelegateClient($this->configuration))->get($id);
    }

    /**
     * @deprecated use file()->getDownloadPath() instead.
     */
    public function getFileDownloadPath(string $id): FileDownloadPathResourceInterface
    {
        return (new FileDelegateClient($this->configuration))->getDownloadPath($id);
    }

    /**
     * @deprecated use file()->download() instead.
     */
    public function downloadFile(string $id): StreamInterface
    {
        return (new FileDelegateClient($this->configuration))->download($id);
    }

    public function createArtworkIssue(string $id, ArtworkIssueResource $issue): ArtworkIssueResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPost(sprintf('/artworks/%s/issues', $id));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($issue));

        /** @var ArtworkIssueResource $resource */
        $resource = $this->request($context, new ArtworkIssueResource());

        return $resource;
    }
}
