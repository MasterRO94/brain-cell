<?php
/**
 * @maintainer Alex Moon <alex.moon@printed.com>
 */

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\Transfer\AbstractResource;

class StatusResource extends AbstractResource
{
    /**
     * @var string $state
     */
    protected $state;

    /**
     * @var string $message
     */
    protected $message;

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

}
