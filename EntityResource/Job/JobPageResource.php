<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Artwork\ArtworkResource;
use Brain\Cell\EntityResource\Stock\MaterialResource;
use Brain\Cell\EntityResource\Stock\SizeResource;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class JobPageResource extends AbstractResource
{
    const STATUS_INVALID_OPTIONS = 1;
    const STATUS_MISSING_ARTWORK = 2;
    const STATUS_READY = 200;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $status;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     */
    protected $rangeStart;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     */
    protected $rangeEnd;

    /**
     * @var ResourceCollection|JobPageOptionResource[]
     *
     * @Assert\Valid()
     * @Assert\Expression(
     *     expression="this.getOptions() && this.getOptions().count() > 0",
     *     message="There must be options specified for the page"
     * )
     */
    protected $options;

    /**
     * @var ArtworkResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $artwork;

    /**
     * @var SizeResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $size;

    /**
     * @var MaterialResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $material;

    /**
     * @var int
     */
    protected $weight;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources()
    {
        return [
            'artwork' => ArtworkResource::class,
            'size' => SizeResource::class,
            'material' => MaterialResource::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'options' => JobPageOptionResource::class
        ];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ResourceCollection|JobPageOptionResource[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param ResourceCollection|JobPageOptionResource[] $options
     *
     * @return JobPageResource
     */
    public function setOptions(ResourceCollection $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int
     */
    public function getRangeStart()
    {
        return $this->rangeStart;
    }

    /**
     * @param int $rangeStart
     *
     * @return JobPageResource
     */
    public function setRangeStart($rangeStart)
    {
        $this->rangeStart = $rangeStart;
        return $this;
    }

    /**
     * @return int
     */
    public function getRangeEnd()
    {
        return $this->rangeEnd;
    }

    /**
     * @param int $rangeEnd
     *
     * @return JobPageResource
     */
    public function setRangeEnd($rangeEnd)
    {
        $this->rangeEnd = $rangeEnd;
        return $this;
    }

    /**
     * @return ArtworkResource
     */
    public function getArtwork()
    {
        return $this->artwork;
    }

    /**
     * @param ArtworkResource $artwork
     *
     * @return JobPageResource
     */
    public function setArtwork(ArtworkResource $artwork)
    {
        $this->artwork = $artwork;
        return $this;
    }

    /**
     * @return SizeResource
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param SizeResource $size
     *
     * @return JobPageResource
     */
    public function setSize(SizeResource $size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return MaterialResource
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * @param MaterialResource $material
     *
     * @return JobPageResource
     */
    public function setMaterial(MaterialResource $material)
    {
        $this->material = $material;
        return $this;
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
     *
     * @return JobPageResource
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

}
