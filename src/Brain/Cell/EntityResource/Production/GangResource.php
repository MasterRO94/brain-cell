<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Production;

use Brain\Cell\EntityResource\Artwork\ArtworkFileResource;
use Brain\Cell\EntityResource\Artwork\ArtworkIssueResource;
use Brain\Cell\EntityResource\Common\AbstractStatusResource;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\EntityResource\Job\JobResourceInterface;
use Brain\Cell\EntityResource\Prototype\ResourceAliasTrait;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

/**
 * {@inheritdoc}
 */
final class GangResource extends AbstractResource implements GangResourceInterface
{
    use ResourceIdentityTrait;
    use ResourceAliasTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;

    /** @var JobResource[]|ResourceCollection */
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
     * @inheritDoc
     */
    public function getJobs():ResourceCollection
    {
        return $this->jobs;
    }
}
