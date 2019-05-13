<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\EntityResource\Stock\MaterialResourceInterface;
use Brain\Cell\Logical\Dimension\TwoDimensionalInterface;
use Brain\Cell\Transfer\ResourceCollection;
use Brain\Cell\TransferEntityInterface;

/**
 * A job component.
 */
interface JobComponentResourceInterface extends
    TransferEntityInterface,
    ResourceIdentityInterface
{
    public function getRangeStart(): int;

    public function getRangeEnd(): int;

    /**
     * Return the component material.
     */
    public function getMaterial(): MaterialResourceInterface;

    /**
     * Return the component dimensions.
     */
    public function getDimensions(): TwoDimensionalInterface;

    /**
     * Return the component level options.
     *
     * @return ResourceCollection|JobComponentOptionResourceInterface[]
     */
    public function getOptions(): ResourceCollection;
}
