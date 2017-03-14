<?php

namespace Brain\Cell\EntityResource\Stock;

use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class FinishingCategoryResource extends AbstractResource
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    protected $alias;
    
    /**
     * @var string
     */
    protected $name;

    /**
     * @var FinishingItemResource[]
     */
    protected $options = [];

    /**
     * @var int
     */
    protected $assignmentLevel;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections()
    {
        return [
            'options' => FinishingItemResource::CLASS
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
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     *
     * @return FinishingCategoryResource
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
     * @return FinishingCategoryResource
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return ResourceCollection|FinishingItemResource[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param ResourceCollection|FinishingItemResource[] $options
     *
     * @return FinishingCategoryResource
     */
    public function setOptions(ResourceCollection $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return int
     */
    public function getAssignmentLevel()
    {
        return $this->assignementLevel;
    }

    /**
     * @param int $assignementLevel
     */
    public function setAssignmentLevel(int $assignmentLevel)
    {
        $this->assignementLevel = $assignementLevel;
    }

}
