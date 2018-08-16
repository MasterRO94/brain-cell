<?php

namespace Brain\Cell\EntityResource\Job\ClientWorkflow;

use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Interfaces\ResourcePublicIdInterface;
use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;

class TransitionResource extends AbstractResource implements ResourcePublicIdInterface
{
    use ResourcePublicIdTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;

    /**
     * @var PhaseResource
     */
    protected $from;

    /**
     * @var PhaseResource
     */
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

    /**
     * @return PhaseResource
     */
    public function getFrom(): PhaseResource
    {
        return $this->from;
    }

    /**
     * @param PhaseResource $from
     */
    public function setFrom(PhaseResource $from): void
    {
        $this->from = $from;
    }

    /**
     * @return PhaseResource
     */
    public function getTo(): PhaseResource
    {
        return $this->to;
    }

    /**
     * @param PhaseResource $to
     */
    public function setTo(PhaseResource $to): void
    {
        $this->to = $to;
    }
}
