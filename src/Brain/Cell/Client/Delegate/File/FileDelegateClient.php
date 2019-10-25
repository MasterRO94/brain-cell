<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\File;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\File\FileDownloadPathResource;
use Brain\Cell\EntityResource\File\FileDownloadPathResourceInterface;
use Brain\Cell\EntityResource\File\FileResource;
use Brain\Cell\EntityResource\File\FileResourceInterface;

use Psr\Http\Message\StreamInterface;

/**
 * {@inheritdoc}
 */
/* final */class FileDelegateClient extends DelegateClient
{
    /**
     * Return a file by id.
     */
    public function get(string $id): FileResourceInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet(sprintf('/files/%s', $id));

        /** @var FileResource $resource */
        $resource = $this->request($context, new FileResource());

        return $resource;
    }

    /**
     * Return the file download path (S3) by id.
     */
    public function getDownloadPath(string $id): FileDownloadPathResourceInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet(sprintf('/files/%s/download-path', $id));

        /** @var FileDownloadPathResource $resource */
        $resource = $this->request($context, new FileDownloadPathResource());

        return $resource;
    }

    /**
     * Download a file by id.
     */
    public function download(string $id): StreamInterface
    {
        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForGet(sprintf('/files/%s/download', $id));

        return $this->stream($context);
    }
}
