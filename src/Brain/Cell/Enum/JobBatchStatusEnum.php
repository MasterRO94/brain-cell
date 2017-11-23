<?php

namespace Brain\Cell\Enum;

/**
 * Copy-paste of Brain/Component/Job/Enum/JobBatchStatusEnum.php in Brain
 * Please keep these synchronised.
 *
 * @deprecated use JobBatchStatusResource constants instead.
 */
class JobBatchStatusEnum
{
    const STATUS_INCOMPLETE = 'incomplete';
    const STATUS_READY = 'ready';


    public static function getAll(): array
    {
        return [
            static::STATUS_INCOMPLETE,
            static::STATUS_READY,
        ];
    }
}
