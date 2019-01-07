<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Stock\Finishing;

use Brain\Cell\EntityResource\Prototype\ResourceAliasTrait;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class FinishingCategoryResource extends AbstractResource implements
    FinishingCategoryResourceInterface
{
    use ResourceIdentityTrait;
    use ResourceAliasTrait;

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

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the human-readable name.
     */
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
