<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Artifact\ArtifactResource;
use Brain\Cell\EntityResource\Artwork\ArtworkResource;
use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Interfaces\ResourcePublicIdInterface;
use Brain\Cell\EntityResource\Job\ClientWorkflow\PhaseResource;
use Brain\Cell\EntityResource\PriceResource;
use Brain\Cell\EntityResource\Product\ProductResource;
use Brain\Cell\EntityResource\ThreeDimensionalResource;
use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
class JobResource extends AbstractResource implements ResourcePublicIdInterface
{
    use ResourcePublicIdTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;

    /**
     * @todo more general implementation
     *
     * @see https://projects.printed.systems/browse/BRN-742
     */
    const PREFLIGHT_FAILURE_POLICY_FIX = 'fix';
    const PREFLIGHT_FAILURE_POLICY_CANCEL = 'cancel';
    const PREFLIGHT_FAILURE_POLICY_IGNORE = 'ignore';

    /** @var JobClientResource[]|ResourceCollection */
    protected $clients;

    /** @var JobStatusResource $status */
    protected $status;

    /** @var ProductResource */
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

    /**
     * @var JobQueryResource[]
     */
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

    /**
     * @var JobOptionResource[]|ResourceCollection
     */
    protected $options;

    /**
     * @var JobNoteResource[]|ResourceCollection
     */
    protected $notes;

    /**
     * @var JobBatchResource
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

    /**
     * @var PriceResource
     */
    protected $price;

    /**
     * @var string
     */
    protected $reference;

    /**
     * @var ArtifactResource[]|ResourceCollection
     */
    protected $artifacts;

    /**
     * @var JobResource
     */
    protected $clonedFrom;

    /**
     * @var JobMetaResource
     */
    protected $meta;

    /**
     * @var PhaseResource
     */
    protected $phase;

    /**
     * @var string
     */
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
     * Return the artwork of the first component against the job.
     *
     * @deprecated This is a BC method and should not be used.
     */
    public function getArtwork(): ArtworkResource
    {
        return $this->components[0]->getArtwork();
    }

    /**
     * @return JobStatusResource
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param JobStatusResource $status
     *
     * @return $this
     */
    public function setStatus(JobStatusResource $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return JobClientResource[]|ResourceCollection
     */
    public function getClients(): ResourceCollection
    {
        return $this->clients;
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
     * @return ProductResource
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param ProductResource $product
     *
     * @return $this
     */
    public function setProduct(ProductResource $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return JobBatchResource
     */
    public function getBatch()
    {
        return $this->batch;
    }

    /**
     * @param JobBatchResource $batch
     *
     * @return $this
     */
    public function setBatch($batch)
    {
        $this->batch = $batch;

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
     * @return JobResource
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     *
     * @return JobResource
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @deprecated
     * use JobBatchBatchDeliveryResource::getEndOfProductionDate
     * instead
     *
     * @return DateResource
     */
    public function getProductionFinishDate()
    {
        return $this->productionFinishDate;
    }

    /**
     * @deprecated
     * use JobBatchBatchDeliveryResource::setEndOfProductionDate
     *
     * @param DateResource $productionFinishDate
     *
     * @return JobResource
     */
    public function setProductionFinishDate(DateResource $productionFinishDate)
    {
        $this->productionFinishDate = $productionFinishDate;

        return $this;
    }

    /**
     * @return JobComponentResource[]|ResourceCollection
     */
    public function getComponents()
    {
        return $this->components;
    }

    /**
     * @param JobComponentResource[]|ResourceCollection $components
     *
     * @return $this
     */
    public function setComponents(ResourceCollection $components)
    {
        $this->components = $components;

        return $this;
    }

    /**
     * @return JobOptionResource[]|ResourceCollection
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param JobOptionResource[]|ResourceCollection $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return JobNoteResource[]|ResourceCollection
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param JobNoteResource[]|ResourceCollection $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    /**
     * @return ThreeDimensionalResource
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * @param ThreeDimensionalResource $dimensions
     *
     * @return JobResource
     */
    public function setDimensions($dimensions)
    {
        $this->dimensions = $dimensions;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasQuery()
    {
        return $this->hasQuery;
    }

    /**
     * @param bool $hasQuery
     */
    public function setHasQuery($hasQuery)
    {
        $this->hasQuery = $hasQuery;
    }

    /**
     * @return PriceResource
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param PriceResource $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return int
     */
    public function getPageCount()
    {
        $pages = 1;
        foreach ($this->components as $component) {
            $pages += $component->getRangeEnd() - $component->getRangeStart();
        }

        return $pages;
    }

    /**
     * @return int
     */
    public function getSheetCount()
    {
        $sheets = 0;
        foreach ($this->components as $component) {
            $sheets += $component->getProductionSheetCount();
        }

        return $sheets;
    }

    /**
     * @param string $optionCategoryAlias
     *
     * @return bool
     */
    protected function has($optionCategoryAlias)
    {
        foreach ($this->components as $component) {
            foreach ($component->getOptions() as $option) {
                if (
                    $option->getCategory()->getAlias() === $optionCategoryAlias
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
    public function hasWhiteInk()
    {
        return $this->has('finishing-white-ink');
    }

    /**
     * @deprecated Use domain models in your project for this.
     */
    public function hasFoiling()
    {
        return $this->has('finishing-foiling');
    }

    /**
     * @deprecated Use domain models in your project for this.
     */
    public function hasLaserCutting()
    {
        return $this->has('finishing-laser-cutting');
    }

    /**
     * @deprecated Use domain models in your project for this.
     */
    public function hasReversePrinting()
    {
        return $this->has('finishing-reverse-printing');
    }

    /**
     * @deprecated Use domain models in your project for this.
     */
    public function hasCorners()
    {
        return $this->has('finishing-corners');
    }

    /**
     * @deprecated Use domain models in your project for this.
     */
    public function hasPersonalisation()
    {
        return $this->has('finishing-personalisation');
    }

    /**
     * @deprecated Use domain models in your project for this.
     */
    public function isMultipage()
    {
        if ($this->components->count() > 1) {
            return true;
        }

        if (1 == $this->components->count()) {
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
    public function isOutsource()
    {
        return false;
    }

    /**
     * @deprecated Use domain models in your project for this.
     */
    public function isLitho()
    {
        return false;
    }

    /**
     * @deprecated Use domain models in your project for this.
     */
    public function isBespoke()
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
    public function setArtifacts(ResourceCollection $artifacts)
    {
        $this->artifacts = $artifacts;
    }

    /**
     * @return JobResource
     */
    public function getClonedFrom()
    {
        return $this->clonedFrom;
    }

    /**
     * @return bool
     */
    public function isInImposition()
    {
        return JobStatusResource::STATUS_IMPOSITION_QUEUED === $this->status->getCanonical()
            || JobStatusResource::STATUS_IMPOSITION_MANUAL === $this->status->getCanonical();
    }

    /**
     * @return JobMetaResource
     */
    public function getMeta(): JobMetaResource
    {
        return $this->meta;
    }

    /**
     * @param JobMetaResource $meta
     */
    public function setMeta(JobMetaResource $meta)
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
    public function setQueries(ResourceCollection $queries)
    {
        $this->queries = $queries;
    }

    /**
     * @return PhaseResource
     */
    public function getPhase(): ?PhaseResource
    {
        return $this->phase;
    }

    /**
     * @param PhaseResource $phase
     */
    public function setPhase(?PhaseResource $phase): void
    {
        $this->phase = $phase;
    }

    /**
     * @return string
     */
    public function getPreflightFailurePolicy(): string
    {
        return $this->preflightFailurePolicy;
    }

    /**
     * @param string $preflightFailurePolicy
     */
    public function setPreflightFailurePolicy(string $preflightFailurePolicy): void
    {
        $this->preflightFailurePolicy = $preflightFailurePolicy;
    }
}
