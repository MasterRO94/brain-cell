<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job\ClientWorkflow;

use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;

class TransitionResource extends AbstractResource implements ResourceIdentityInterface
{
    use ResourceIdentityTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;

    /** @var PhaseResource */
    protected $from;

    /** @var PhaseResource */
    protected $to;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'from' => PhaseResource::class,
            'to' => PhaseResource::class,
            'createdAt' => DateResource::class,
            'updatedAt' => DateResource::class,
        ];
    }

    public function getFrom(): PhaseResource
    {
        return $this->from;
    }

    public function setFrom(PhaseResource $from): void
    {
        $this->from = $from;
    }

    public function getTo(): PhaseResource
    {
        return $this->to;
    }

    public function setTo(PhaseResource $to): void
    {
        $this->to = $to;
    }
}
