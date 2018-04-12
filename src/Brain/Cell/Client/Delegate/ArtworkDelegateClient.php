<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;

use Brain\Cell\EntityResource\Artwork\ArtworkIssueResource;
use Psr\Http\Message\StreamInterface;

class ArtworkDelegateClient extends DelegateClient
{
    /**
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
     * @param int $pageNumber
     * @param int|null $width
     * @param int|null $height
     * @return StreamInterface
     */
    public function downloadPreview(string $id, int $pageNumber, int $width = null, int $height = null): StreamInterface
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf('/artworks/%s/pages/%s/preview', $id, $pageNumber));

        if ($width) {
            $context->getParameters()->set('width', $width);
        }

        if ($height) {
            $context->getParameters()->set('height', $height);
        }

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
