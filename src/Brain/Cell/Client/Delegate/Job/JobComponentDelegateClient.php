<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Job;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Artwork\ArtworkResource;
use Brain\Cell\EntityResource\Job\JobComponentResourceInterface;
use Brain\Cell\EntityResource\Job\JobResourceInterface;

class JobComponentDelegateClient extends DelegateClient
{
    public function updateArtwork(
        JobResourceInterface $job,
        JobComponentResourceInterface $component,
        ArtworkResource $artwork
    ): JobComponentResourceInterface {
        $handler = $this->configuration->getResourceHandler();
        $payload = $handler->serialise($artwork);

        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf('/jobs/%s/components/%s/artwork', $job->getId(), $component->getId()));
        $context->setPayload($payload);

        /** @var JobComponentResourceInterface $resource */
        $resource = $this->request($context, $component);

        return $resource;
    }
}
