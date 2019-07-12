<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Stock\Finishing;

use Brain\Cell\EntityResource\Prototype\ResourceAliasTrait;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

/**
 * {@inheritdoc}
 */
final class FinishingCategoryResource extends AbstractResource implements
    FinishingCategoryResourceInterface
{
    use ResourceIdentityTrait;
    use ResourceAliasTrait;

    /** @var string */
    protected $name;

    /** @var FinishingItemResourceInterface[]|ResourceCollection */
    protected $options;

    /** @var string */
    protected $assignmentLevel;

    /** @var string */
    protected $applicationLevel;

    public function __construct()
    {
        $this->options = new ResourceCollection();
        $this->options->setEntityClass(FinishingItemResource::class);
    }

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
     * {@inheritdoc}
     */
    public function getOptions(): ResourceCollection
    {
        return $this->options;
    }

    /**
     * @param FinishingItemResourceInterface[]|ResourceCollection $options
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
