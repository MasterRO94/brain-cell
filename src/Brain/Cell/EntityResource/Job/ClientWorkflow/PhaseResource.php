<?php

namespace Brain\Cell\EntityResource\Job\ClientWorkflow;

use Brain\Cell\EntityResource\Traits\ResourceCreatedUpdatedTrait;
use Brain\Cell\EntityResource\Interfaces\ResourcePublicIdInterface;
use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

use Symfony\Component\Validator\Constraints as Assert;

class PhaseResource extends AbstractResource implements ResourcePublicIdInterface
{
    use ResourcePublicIdTrait;
    use ResourceCreatedUpdatedTrait;

    /**
     * @var string
     */
    protected $canonical;

    /**
     * @var string
     */
    protected $readable;

    /**
     * @var bool
     */
    protected $isEntryPoint;

    /**
     * @var TransitionResource[]|ResourceCollection
     */
    protected $transitions;

    /**
     * @var ClientWorkflowResource
     */
    protected $clientWorkflow;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'clientWorkflow' => ClientWorkflowResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'transitions' => TransitionResource::class,
        ];
    }

    /**
     * Return the canonical status string.
     *
     * @return string
     */
    public function getCanonical()
    {
        return $this->canonical;
    }

    /**
     * Set the canonical status string.
     *
     * @param string $canonical
     */
    public function setCanonical(string $canonical)
    {
        $this->canonical = $canonical;
    }

    /**
     * Return the localised translation.
     *
     * @return string
     */
    public function getReadable()
    {
        return $this->readable;
    }

    public function setReadable(string $readable): void
    {
        $this->readable = $readable;
    }

    /**
     * @return boolean
     */
    public function isIsEntryPoint(): bool
    {
        return $this->isEntryPoint;
    }

    /**
     * @param boolean $isEntryPoint
     */
    public function setIsEntryPoint(bool $isEntryPoint)
    {
        $this->isEntryPoint = $isEntryPoint;
    }


}
