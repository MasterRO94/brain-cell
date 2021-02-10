<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Artwork\ArtworkResourceInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\EntityResource\Stock\MaterialResourceInterface;
use Brain\Cell\EntityResource\Stock\StockDefinitionResourceInterface;
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
    /**
     * Return the job component range details.
     */
    public function getRange(): JobComponentRangeResourceInterface;

    /**
     * The range start will represent the order of which this component should be applied in binding context.
     * It used to represent a start and finish of the component, which included the quantity.
     * This is not so easy to figure out so has been deprecated for new functionality.
     *
     * This method is deprecated and simply proxies the new range resource methods.
     *
     * @deprecated Please use getRange()->getOrder()
     *
     * @see JobComponentRangeResourceInterface
     */
    public function getRangeStart(): int;

    /**
     * The range start will represent the quantity of this component.
     * It used to represent a start and finish of the component, which included the quantity.
     * This is not so easy to figure out so has been deprecated for new functionality.
     *
     * This method is deprecated and simply proxies the new range resource methods.
     *
     * @deprecated Please use getRange()->getQuantity()
     *
     * @see JobComponentRangeResourceInterface
     */
    public function getRangeEnd(): int;

    /**
     * Return the component material.
     */
    public function getMaterial(): MaterialResourceInterface;

    public function setDimensions(TwoDimensionalInterface $dimensional): void;

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

    public function getArtwork(): ArtworkResourceInterface;

    public function setArtwork(ArtworkResourceInterface $artwork): void;

    public function getStockDefinition(): StockDefinitionResourceInterface;
}
