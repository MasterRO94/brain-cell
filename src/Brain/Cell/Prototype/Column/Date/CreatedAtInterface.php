<?php

namespace Brain\Cell\Prototype\Column\Date;

use Brain\Cell\EntityResource\Common\DateResourceInterface;

interface CreatedAtInterface
{
    /**
     * @return DateResourceInterface
     */
    public function getCreatedAt(): DateResourceInterface;
}
