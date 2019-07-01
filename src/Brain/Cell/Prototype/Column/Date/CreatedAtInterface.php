<?php

declare(strict_types=1);

namespace Brain\Cell\Prototype\Column\Date;

use Brain\Cell\EntityResource\Common\DateResourceInterface;

interface CreatedAtInterface
{
    public function getCreatedAt(): DateResourceInterface;
}
