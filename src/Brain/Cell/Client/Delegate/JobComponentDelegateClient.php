<?php

namespace Brain\Cell\Client\Delegate;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Artwork\ArtworkResource;
use Brain\Cell\EntityResource\Job\JobComponentResource;
use Brain\Cell\EntityResource\Job\JobResource;

class JobComponentDelegateClient extends DelegateClient
{
    public function updateArtwork(JobResource $job, JobComponentResource $component, ArtworkResource $artwork): JobComponentResource
    {
        $context = $this->configuration->createRequestContext();
        $context->prepareContextForPut(sprintf(
            '/jobs/{{job_id}}/components/{{job_component_id}}/artwork',
            $job->getId(),
            $component->getId()
        ));

        $handler = $this->configuration->getResourceHandler();
        $context->setPayload($handler->serialise($artwork));

        return $this->request($context, $component);
    }
}
