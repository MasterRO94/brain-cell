<?php

namespace Brain\Cell\EntityResource\Stock;

use Brain\Cell\EntityResource\DimensionsResource;
use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class SizeResource extends AbstractResource
{

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     */
    protected $alias;

    /**
     * @var string
     */
    protected $name;

    public function getAssociatedResources()
    {
        return [
            'dimensions' => DimensionsResource::class,
        ];
    }

    /**
     * @var DimensionsResource
     */
    protected $dimensions;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     *
     * @return SizeResource
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return SizeResource
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return DimensionsResource
     */
    public function getDimensions(): DimensionsResource
    {
        return $this->dimensions;
    }

    /**
     * @param DimensionsResource $dimensions
     * @return SizeResource
     */
    public function setDimensions(DimensionsResource $dimensions)
    {
        $this->dimensions = $dimensions;
        return $this;
    }
}
