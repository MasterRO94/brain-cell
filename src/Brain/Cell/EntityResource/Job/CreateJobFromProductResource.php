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
    public function getAssociatedResources()
    {
        return [
            'artwork' => ArtworkResource::class,
        ];
    }
}
