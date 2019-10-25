<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

/**
 * A job component range resource.
 */
final class JobComponentRangeResource implements
    JobComponentRangeResourceInterface
{
    /** @var int */
    private $order = 1;

    /** @var int */
    private $quantity = 1;

    /**
     * {@inheritdoc}
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * Set the component range order.
     *
     * @see JobComponentRangeResourceInterface::getOrder()
     */
    public function setOrder(int $order): void
    {
        $this->order = $order;
    }

    /**
     * {@inheritdoc}
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Set the component range quantity.
     *
     * @see JobComponentRangeResourceInterface::getQuantity()
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }
}
