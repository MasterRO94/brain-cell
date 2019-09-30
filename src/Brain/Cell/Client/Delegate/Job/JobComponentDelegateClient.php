<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Job;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Artwork\ArtworkHistoryResource;
use Brain\Cell\EntityResource\Artwork\ArtworkHistoryResourceInterface;
use Brain\Cell\EntityResource\Artwork\ArtworkResource;
use Brain\Cell\EntityResource\Job\JobComponentResource;
use Brain\Cell\EntityResource\Job\JobComponentResourceInterface;
use Brain\Cell\EntityResource\Job\JobResourceInterface;
use Brain\Cell\Transfer\ResourceCollection;

class JobComponentDelegateClient extends DelegateClient
{
    public function get(
        string $jobId,
        string $jobComponentId
    ): JobComponentResource {
        $context = $this->configuration->createRequestContext();

        $context->prepareContextForGet(sprintf(
            '/jobs/%s/components/%s',
            $jobId,
            $jobComponentId
        ));

        /** @var JobComponentResource $resource */
        $resource = $this->request($context, new JobComponentResource());

        return $resource;
    }

    /**
     * @return ArtworkHistoryResourceInterface[]|ResourceCollection
     */
    public function getArtworkHistories(
        JobResourceInterface $job,
        JobComponentResourceInterface $component
    ): ResourceCollection {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForGet(sprintf(
            '/jobs/%s/components/%s/artwork-histories',
            $job->getId(),
            $component->getId()
        ));

        $result = new ResourceCollection();
        $result->setEntityClass(ArtworkHistoryResource::class);

        /** @var ResourceCollection $resource */
        $resource = $this->request($context, $result);

        return $resource;
    }

    public function updateArtwork(
        JobResourceInterface $job,
        JobComponentResourceInterface $component,
        ArtworkResource $artwork
    ): JobComponentResourceInterface {
        $handler = $this->configuration->getResourceHandler();
        $payload = $handler->serialise($artwork);

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf(
            '/jobs/%s/components/%s/artwork',
            $job->getId(),
            $component->getId()
        ));
        $context->setPayload($payload);

        /** @var JobComponentResourceInterface $resource */
        $resource = $this->request($context, $component);

        return $resource;
    }
}
