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
    public function downloadPreview($id, $pageNumber, $width = null, $height = null)
    {
        $context = $this->configuration->createRequestContext();
        if ($width) {
            if ($height) {
                $url = sprintf('/artworks/%s/preview/%s/%s/%s', $id, $pageNumber, $width, $height);
            } else {
                $url = sprintf('/artworks/%s/preview/%s/%s', $id, $pageNumber, $width);
            }
        } else {
            $url = sprintf('/artworks/%s/preview/%s', $id, $pageNumber);
        }
        $context->prepareContextForGet($url);
        return $this->stream($context);
    }
}
