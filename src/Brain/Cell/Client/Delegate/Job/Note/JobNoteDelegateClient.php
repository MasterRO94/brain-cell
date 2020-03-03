<?php

declare(strict_types=1);

namespace Brain\Cell\Client\Delegate\Job\Note;

use Brain\Cell\Client\DelegateClient;
use Brain\Cell\EntityResource\Job\JobNoteResource;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\EntityResource\Job\JobResourceInterface;

/**
 * API client for working with job notes.
 */
/* final */class JobNoteDelegateClient extends DelegateClient
{
    /**
     * Create a note against the job.
     */
    public function create(JobResourceInterface $job, JobNoteResource $note): JobResourceInterface
    {
        $id = $job->getId();

        $payload = $this->resourceHandler->serialise($note);

        $context = $this->configuration->createRequestContext(self::VERSION_V1);
        $context->prepareContextForPost(sprintf('/jobs/%s/notes', $id));
        $context->setPayload($payload);

        /** @var JobResource $resource */
        $resource = $this->request($context, new JobResource());

        return $resource;
    }
}
