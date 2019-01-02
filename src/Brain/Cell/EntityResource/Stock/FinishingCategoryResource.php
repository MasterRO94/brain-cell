<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Stock;

use Brain\Cell\EntityResource\Interfaces\ResourcePublicIdInterface;
use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class FinishingCategoryResource extends AbstractResource implements ResourcePublicIdInterface
{
    use ResourcePublicIdTrait;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    protected $alias;

    /** @var string */
    protected $name;

    /** @var FinishingItemResource[] */
    protected $options = [];

    /** @var string */
    protected $assignmentLevel;

    /** @var string */
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

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): void
    {
        $this->alias = $alias;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return FinishingItemResource[]|ResourceCollection
     */
    public function getOptions(): ResourceCollection
    {
        return $this->options;
    }

    /**
     * @param FinishingItemResource[]|ResourceCollection $options
     */
    public function setOptions(ResourceCollection $options): void
    {
        $this->options = $options;
    }

    public function getAssignmentLevel(): string
    {
        return $this->assignmentLevel;
    }

    public function setAssignmentLevel(string $assignmentLevel): void
    {
        $this->assignmentLevel = $assignmentLevel;
    }

    public function getApplicationLevel(): string
    {
        return $this->applicationLevel;
    }

    public function setApplicationLevel(string $applicationLevel): void
    {
        $this->applicationLevel = $applicationLevel;
    }
}
