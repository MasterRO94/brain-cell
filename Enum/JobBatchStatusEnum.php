<?php
/**
 * @maintainer Alex Moon <alex.moon@printed.com>
 */

namespace Brain\Cell\Enum;

/**
 * Copy-paste of Brain/Component/Job/Enum/JobBatchStatusEnum.php in Brain
 * Please keep these synchronised
 */
class JobBatchStatusEnum
{
    const STATUS_INCOMPLETE = 'incomplete';
    const STATUS_READY = 'ready';

    /**
     * {@inheritdoc}
     */
    public static function getAll(): array
    {
        return [
            static::STATUS_INCOMPLETE,
            static::STATUS_READY,
        ];
    }
}
