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
     * @var string
     */
    protected $assignmentLevel;

    /**
     * @var string
     */
    protected $applicationLevel;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections(): array
    {
        return [
            'options' => FinishingItemResource::class,
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
     * @return FinishingItemResource[]|ResourceCollection
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param FinishingItemResource[]|ResourceCollection $options
     *
     * @return FinishingCategoryResource
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return string
     */
    public function getAssignmentLevel()
    {
        return $this->assignmentLevel;
    }

    /**
     * @param string $assignmentLevel
     */
    public function setAssignmentLevel($assignmentLevel)
    {
        $this->assignmentLevel = $assignmentLevel;
    }

    /**
     * @return string
     */
    public function getApplicationLevel()
    {
        return $this->applicationLevel;
    }

    /**
     * @param string $applicationLevel
     */
    public function setApplicationLevel($applicationLevel)
    {
        $this->applicationLevel = $applicationLevel;
    }
}
