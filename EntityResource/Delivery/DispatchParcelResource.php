<?php
/**
 * @maintainer Alex Moon <alex.moon@printed.com>
 */

namespace Brain\Cell\EntityResource\Delivery;

use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

class DispatchParcelResource extends AbstractResource
{
    /** @var int $height */
    protected $height;

    /** @var int $width */
    protected $width;

    /** @var int $depth */
    protected $depth;

    /** @var int $weight */
    protected $weight;

    /** @var DispatchResource $dispatch */
    protected $dispatch;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'dispatch' => DispatchResource::class,
        ];
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * @param int $depth
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return DispatchResource
     */
    public function getDispatch()
    {
        return $this->dispatch;
    }

    /**
     * @param DispatchResource $dispatch
     */
    public function setDispatch($dispatch)
    {
        $this->dispatch = $dispatch;
    }
}
