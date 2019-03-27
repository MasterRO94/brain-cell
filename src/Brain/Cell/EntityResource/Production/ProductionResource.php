<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Production;

use Brain\Cell\EntityResource\Common\AbstractStatusResource;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\EntityResource\Job\JobResourceInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Transfer\AbstractResource;

/**
 * {@inheritdoc}
 */
final class ProductionResource extends AbstractResource implements
    ProductionResourceInterface
{
    use ResourceIdentityTrait;

    /** @var ProductionStatusResource */
    protected $status;

    /** @var JobResourceInterface */
    protected $job;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'status' => ProductionStatusResource::class,
            'job' => JobResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getStatus(): AbstractStatusResource
    {
        return $this->status;
    }

    /**
     * {@inheritdoc}
     */
    public function getJob(): JobResourceInterface
    {
        return $this->job;
    }

    /**
     * Set the job.
     */
    public function setJob(JobResourceInterface $job): void
    {
        $this->job = $job;
    }
}
