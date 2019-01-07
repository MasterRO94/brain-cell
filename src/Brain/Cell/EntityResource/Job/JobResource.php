<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Artifact\ArtifactResource;
use Brain\Cell\EntityResource\Artwork\ArtworkResource;
use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Job\ClientWorkflow\PhaseResource;
use Brain\Cell\EntityResource\PriceResource;
use Brain\Cell\EntityResource\Product\ProductResource;
use Brain\Cell\EntityResource\Product\ProductResourceInterface;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\EntityResource\ThreeDimensionalResource;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class JobResource extends AbstractResource implements
    JobResourceInterface
{
    use ResourceIdentityTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;

    /**
     * @todo more general implementation
     *
     * @see https://projects.printed.systems/browse/BRN-742
     */
    public const PREFLIGHT_FAILURE_POLICY_FIX = 'job.preflight_failure_policy.fix';
    public const PREFLIGHT_FAILURE_POLICY_CANCEL = 'job.preflight_failure_policy.cancel';
    public const PREFLIGHT_FAILURE_POLICY_IGNORE = 'job.preflight_failure_policy.ignore';

    /** @var string|null */
    protected $hash;

    /** @var JobClientResource[]|ResourceCollection */
    protected $clients;

    /** @var JobStatusResource $status */
    protected $status;

    /** @var ProductResourceInterface|null */
    protected $product;

    /** @var int */
    protected $weight;

    /** @var int */
    protected $quantity;

    /**
     * @deprecated use JobBatchBatchDeliveryResource::$endOfProductionDate instead
     *
     * @var DateResource
     */
    protected $productionFinishDate;

    /** @var JobQueryResource[] */
    protected $queries;

    /**
     * @var JobComponentResource[]|ResourceCollection
     *
     * @Assert\Valid()
     * @Assert\Expression(
     *     expression="this.getComponents() && this.getComponents().count() > 0",
     *     message="There must be at least one component supplied"
     * )
     */
    protected $components;

    /** @var JobOptionResource[]|ResourceCollection */
    protected $options;

    /** @var JobNoteResource[]|ResourceCollection */
    protected $notes;

    /**
     * @var JobBatchResourceInterface|null
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $batch;

    /**
     * @var ThreeDimensionalResource
     *
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    protected $dimensions;

    /** @var PriceResource */
    protected $price;

    /** @var string */
    protected $reference;

    /** @var ArtifactResource[]|ResourceCollection */
    protected $artifacts;

    /** @var JobResource */
    protected $clonedFrom;

    /** @var JobMetaResource */
    protected $meta;

    /** @var PhaseResource */
    protected $phase;

    /** @var string */
    protected $preflightFailurePolicy;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'product' => ProductResource::class,
            'batch' => JobBatchResource::class,
            'dimensions' => ThreeDimensionalResource::class,
            'price' => PriceResource::class,
            'status' => JobStatusResource::class,
            'clonedFrom' => self::class,
            'meta' => JobMetaResource::class,
            'phase' => PhaseResource::class,
            'productionFinishDate' => DateResource::class,
            'createdAt' => DateResource::class,
            'updatedAt' => DateResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCollections(): array
    {
        return [
            'clients' => JobClientResource::class,
            'components' => JobComponentResource::class,
            'options' => JobOptionResource::class,
            'notes' => JobNoteResource::class,
            'artifacts' => ArtifactResource::class,
            'queries' => JobQueryResource::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getHash(): ?string
    {
        return $this->hash;
    }

    /**
     * Return the artwork of the first component against the job.
     *
     * @deprecated This is a BC method and should not be used.
     */
    public function getArtwork(): ArtworkResource
    {
        return $this->components[0]->getArtwork();
    }

    public function getStatus(): JobStatusResource
    {
        return $this->status;
    }

    public function setStatus(JobStatusResource $status): void
    {
        $this->status = $status;
    }

    /**
     * @return JobClientResource[]|ResourceCollection
     */
    public function getClients(): ResourceCollection
    {
        return $this->clients;
    }

    /**
     * @param JobClientResource[]|ResourceCollection $clients
     */
    public function setClients(ResourceCollection $clients): void
    {
        $this->clients = $clients;
    }

    /**
     * @deprecated Client now belongs in the clients collection.
     */
    public function getShop(): void
    {
    }

    /**
     * @deprecated Client now belongs in the clients collection.
     */
    public function getProductionHouse(): void
    {
    }

    /**
     * @deprecated Client now belongs in the clients collection.
     */
    public function getPrepressTeam(): void
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getProduct(): ?ProductResourceInterface
    {
        return $this->product;
    }

    /**
     * Set the product against the job.
     */
    public function setProduct(?ProductResourceInterface $product): void
    {
        $this->product = $product;
    }

    /**
     * {@inheritdoc}
     */
    public function getBatch(): ?JobBatchResourceInterface
    {
        return $this->batch;
    }

    /**
     * @deprecated This should not be used, if you are using it for tests mock the interface.
     */
    public function setBatch(JobBatchResourceInterface $batch): void
    {
        $this->batch = $batch;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * {@inheritdoc}
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Set the quantity of this job to be produced.
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @deprecated use JobBatchBatchDeliveryResource::getEndOfProductionDate instead.
     */
    public function getProductionFinishDate(): DateResource
    {
        return $this->productionFinishDate;
    }

    /**
     * @deprecated use JobBatchBatchDeliveryResource::setEndOfProductionDate instead.
     */
    public function setProductionFinishDate(DateResource $productionFinishDate): void
    {
        $this->productionFinishDate = $productionFinishDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getComponents(): ResourceCollection
    {
        return $this->components;
    }

    /**
     * Set the job components.
     *
     * @param JobComponentResourceInterface[]|ResourceCollection $components
     */
    public function setComponents(ResourceCollection $components): void
    {
        $this->components = $components;
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions(): ResourceCollection
    {
        return $this->options;
    }

    /**
     * @param JobOptionResourceInterface[]|ResourceCollection $options
     */
    public function setOptions(ResourceCollection $options): void
    {
        $this->options = $options;
    }

    /**
     * @return JobNoteResource[]|ResourceCollection
     */
    public function getNotes(): ResourceCollection
    {
        return $this->notes;
    }

    /**
     * @param JobNoteResource[]|ResourceCollection $notes
     */
    public function setNotes(ResourceCollection $notes): void
    {
        $this->notes = $notes;
    }

    public function getDimensions(): ThreeDimensionalResource
    {
        return $this->dimensions;
    }

    public function setDimensions(ThreeDimensionalResource $dimensions): void
    {
        $this->dimensions = $dimensions;
    }

    /**
     * @deprecated This has no implementation.
     */
    public function hasQuery(): bool
    {
        return false;
    }

    /**
     * @deprecated This has no implementation.
     */
    public function setHasQuery(bool $hasQuery): void
    {
    }

    public function getPrice(): PriceResource
    {
        return $this->price;
    }

    public function setPrice(PriceResource $price): void
    {
        $this->price = $price;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    public function getPageCount(): int
    {
        $pages = 1;
        foreach ($this->components as $component) {
            $pages += $component->getRangeEnd() - $component->getRangeStart();
        }

        return $pages;
    }

    public function getSheetCount(): int
    {
        $sheets = 0;
        foreach ($this->components as $component) {
            $sheets += $component->getProductionSheetCount();
        }

        return $sheets;
    }

    protected function has(string $optionCategoryAlias): bool
    {
        foreach ($this->components as $component) {
            foreach ($component->getOptions() as $option) {
                if ($option->getFinishingCategory()->getAlias() === $optionCategoryAlias
                    && !$option->getFinishingItem()->isDefault()
                ) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @deprecated Use domain models in your project for this.
     */
    public function hasWhiteInk(): bool
    {
        return $this->has('finishing-white-ink');
    }

    /**
     * @deprecated Use domain models in your project for this.
     */
    public function hasFoiling(): bool
    {
        return $this->has('finishing-foiling');
    }

    /**
     * @deprecated Use domain models in your project for this.
     */
    public function hasLaserCutting(): bool
    {
        return $this->has('finishing-laser-cutting');
    }

    /**
     * @deprecated Use domain models in your project for this.
     */
    public function hasReversePrinting(): bool
    {
        return $this->has('finishing-reverse-printing');
    }

    /**
     * @deprecated Use domain models in your project for this.
     */
    public function hasCorners(): bool
    {
        return $this->has('finishing-corners');
    }

    /**
     * @deprecated Use domain models in your project for this.
     */
    public function hasPersonalisation(): bool
    {
        return $this->has('finishing-personalisation');
    }

    /**
     * @deprecated Use domain models in your project for this.
     */
    public function isMultipage(): bool
    {
        if ($this->components->count() > 1) {
            return true;
        }

        if ($this->components->count() === 1) {
            /** @var JobComponentResource $firstComponent */
            $firstComponent = $this->components->first();
            if ($firstComponent->getRangeEnd() > 1) {
                return true;
            }
        }

        return false;
    }

    /**
     * @deprecated Use domain models in your project for this.
     */
    public function isOutsource(): bool
    {
        return false;
    }

    /**
     * @deprecated Use domain models in your project for this.
     */
    public function isLitho(): bool
    {
        return false;
    }

    /**
     * @deprecated Use domain models in your project for this.
     */
    public function isBespoke(): bool
    {
        return false;
    }

    /**
     * @return ArtifactResource[]|ResourceCollection
     */
    public function getArtifacts(): ResourceCollection
    {
        return $this->artifacts;
    }

    /**
     * @param ArtifactResource[]|ResourceCollection $artifacts
     */
    public function setArtifacts(ResourceCollection $artifacts): void
    {
        $this->artifacts = $artifacts;
    }

    public function getClonedFrom(): JobResource
    {
        return $this->clonedFrom;
    }

    public function isInImposition(): bool
    {
        return $this->status->getCanonical() === JobStatusResource::STATUS_IMPOSITION_QUEUED
            || $this->status->getCanonical() === JobStatusResource::STATUS_IMPOSITION_MANUAL;
    }

    public function getMeta(): JobMetaResource
    {
        return $this->meta;
    }

    public function setMeta(JobMetaResource $meta): void
    {
        $this->meta = $meta;
    }

    /**
     * @return JobQueryResource[]|ResourceCollection
     */
    public function getQueries(): ResourceCollection
    {
        return $this->queries;
    }

    /**
     * @param JobQueryResource[]|ResourceCollection $queries
     */
    public function setQueries(ResourceCollection $queries): void
    {
        $this->queries = $queries;
    }

    public function getPhase(): ?PhaseResource
    {
        return $this->phase;
    }

    public function setPhase(?PhaseResource $phase): void
    {
        $this->phase = $phase;
    }

    public function getPreflightFailurePolicy(): string
    {
        return $this->preflightFailurePolicy;
    }

    public function setPreflightFailurePolicy(string $preflightFailurePolicy): void
    {
        $this->preflightFailurePolicy = $preflightFailurePolicy;
    }
}
