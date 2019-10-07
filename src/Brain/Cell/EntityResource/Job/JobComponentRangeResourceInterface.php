<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\TransferEntityInterface;

/**
 * A job component range resource.
 */
interface JobComponentRangeResourceInterface extends
    TransferEntityInterface
{
    /**
     * Return the component order.
     *
     * This is a non-zero based integer that represents the order in which this
     * component will be placed should a binding method be supplied.
     *
     * In almost all cases this can remain as 1.
     */
    public function getOrder(): int;

    /**
     * Return the component quantity.
     *
     * This is the quantity of this component that should be produced.
     *
     * In almost all cases this can remain as 1.
     * For jobs that have a binding this would be different.
     */
    public function getQuantity(): int;
}
