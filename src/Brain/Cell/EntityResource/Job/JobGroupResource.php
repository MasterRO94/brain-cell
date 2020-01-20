<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class JobGroupResource extends AbstractResource implements
    JobGroupResourceInterface
{
    use ResourceIdentityTrait;

    /** @var string|null */
    protected $hash;

    /**
     * @Assert\Valid()
     * @Assert\Expression(
     *     expression="this.getJobs() && this.getJobs().count() > 0",
     *     message="There must be jobs specified for the group"
     * )
     *
     * @var JobResourceInterface[]|ResourceCollection
     */
    protected $jobs;

    public function __construct()
    {
        $this->jobs = new ResourceCollection();
        $this->jobs->setEntityClass(JobResource::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections(): array
    {
        return [
            'jobs' => JobResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getHash(): ?string
    {
        return $this->hash;
    }

    /**
     * {@inheritdoc}
     */
    public function getJobs(): ResourceCollection
    {
        return $this->jobs;
    }

    /**
     * Set the jobs in the group.
     *
     * @deprecated Unsure if this is allowed, check API endpoints in Brain.
     *
     * @param JobResourceInterface[]|ResourceCollection $jobs
     */
    public function setJobs($jobs): void
    {
        $this->jobs = $jobs;
    }
}
