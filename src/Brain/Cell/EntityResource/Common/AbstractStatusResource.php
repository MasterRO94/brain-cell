<?php

namespace Brain\Cell\EntityResource\Common;

use Brain\Cell\Transfer\AbstractResource;

/**
 * A common status resource.
 */
abstract class AbstractStatusResource extends AbstractResource
{
    /**
     * The canonical status string.
     *
     * @var string
     */
    protected $canonical;

    /**
     * @var string
     *
     * @deprecated To be removed in 2.0, use canonical instead.
     */
    protected $state;

    /**
     * The localised translation.
     *
     * @var string
     */
    protected $message;

    /**
     * @return string
     *
     * @deprecated To be removed in 2.0, use canonical instead.
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     *
     * @deprecated To be removed in 2.0, use canonical instead.
     */
    public function setState($state)
    {
        $this->state = $state;
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
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @deprecated To be removed in 2.0, you should never need to set the status.
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
}
