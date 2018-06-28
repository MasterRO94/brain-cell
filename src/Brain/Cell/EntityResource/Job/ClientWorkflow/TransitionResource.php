<?php

namespace Brain\Cell\EntityResource\Job\ClientWorkflow;

use Brain\Cell\EntityResource\Traits\ResourceCreatedUpdatedTrait;
use Brain\Cell\EntityResource\Interfaces\ResourcePublicIdInterface;
use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

class TransitionResource extends AbstractResource implements ResourcePublicIdInterface
{
    use ResourcePublicIdTrait;
    use ResourceCreatedUpdatedTrait;

    /**
     * @var PhaseResource
     */
    protected $from;

    /**
     * @var PhaseResource
     */
    protected $to;

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
