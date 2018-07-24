<?php

namespace Brain\Cell\EntityResource;

use Brain\Cell\EntityResource\Artwork\ArtworkResource;
use Brain\Cell\EntityResource\Interfaces\ResourcePublicIdInterface;
use Brain\Cell\EntityResource\PriceResource;
use Brain\Cell\EntityResource\Product\ProductResource;
use Brain\Cell\EntityResource\ProductionHouseResource;
use Brain\Cell\EntityResource\ShopResource;
use Brain\Cell\EntityResource\ThreeDimensionalResource;
use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Enum\JobStatusEnum;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class StockDefinitionResource extends AbstractResource implements ResourcePublicIdInterface
{

    use ResourcePublicIdTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var int
     */
    protected $width;

    /**
     * @var int
     */
    protected $height;

    /**
     * @var int
     */
    protected $stripWidth;

    /**
     * @var int
     */
    protected $stripQuantity;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getStripWidth()
    {
        return $this->stripWidth;
    }

    /**
     * @return int
     */
    public function getStripQuantity()
    {
        return $this->stripQuantity;
    }
}
