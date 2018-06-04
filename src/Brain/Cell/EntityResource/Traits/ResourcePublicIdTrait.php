<?php

namespace Brain\Cell\EntityResource\Traits;

/**
 * Trait ResourcePublicIdTrait.
 *
 * A trait for resources with uuid public id.
 */
trait ResourcePublicIdTrait
{
    /** @var string|null */
    protected $id;

    /**
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIdOrThrow()
    {
        if (!$this->id) {
            throw new \RuntimeException("Couldn't retrieve resource's id, because it's not set.");
        }

        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }
}
