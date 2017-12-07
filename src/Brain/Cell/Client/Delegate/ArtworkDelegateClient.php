<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;

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
     *
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
}
