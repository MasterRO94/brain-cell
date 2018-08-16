<?php

namespace Brain\Cell\EntityResource\Job;

use Brain\Cell\EntityResource\Artwork\ArtworkResource;
use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Transfer\AbstractResource;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * {@inheritdoc}
 */
final class CreateJobFromProductResource extends AbstractResource
{
    use ResourcePublicIdTrait;

    /**
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $reference;

    /**
     * @Assert\NotBlank()
     *
     * @var int
     */
    protected $quantity;

    /**
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $productSku;

    /**
     * @Assert\Valid()
     * @Assert\NotBlank()
     *
     * @var ArtworkResource
     */
    protected $artwork;

    /**
     * {@inheritdoc}
     */
    public function getAssociatedResources(): array
    {
        return [
            'artwork' => ArtworkResource::class,
        ];
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getProductSku(): string
    {
        return $this->productSku;
    }

    public function setProductSku(string $productSku): void
    {
        $this->productSku = $productSku;
    }

    public function getArtwork(): ArtworkResource
    {
        return $this->artwork;
    }

    public function setArtwork(ArtworkResource $artwork): void
    {
        $this->artwork = $artwork;
    }
}
