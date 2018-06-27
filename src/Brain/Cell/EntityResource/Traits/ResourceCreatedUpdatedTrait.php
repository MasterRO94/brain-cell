<?php

namespace vendor\brain\cell\src\Brain\Cell\EntityResource\Traits;

/**
 * A trait for resources with a created and updated datetime.
 */
trait ResourceCreatedUpdatedTrait
{
    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var \DateTime
     */
    protected $updated;

    /**
     * {@inheritdoc}
     */
    public function getDateTimeProperties()
    {
        return [
            'created',
            'updated',
        ];
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created): void
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated(): \DateTime
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     */
    public function setUpdated(\DateTime $updated): void
    {
        $this->updated = $updated;
    }
}
