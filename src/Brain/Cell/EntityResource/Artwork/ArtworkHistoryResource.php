<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Artwork;

use Brain\Cell\EntityResource\ClientResource;
use Brain\Cell\EntityResource\Common\DateResource;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityTrait;
use Brain\Cell\EntityResource\UserResource;
use Brain\Cell\Prototype\Column\Date\CreatedAtTrait;
use Brain\Cell\Prototype\Column\Date\UpdatedAtTrait;
use Brain\Cell\Transfer\AbstractResource;

class ArtworkHistoryResource extends AbstractResource implements ArtworkHistoryResourceInterface
{
    use ResourceIdentityTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;

    public function getAssociatedResources(): array
    {
        return [
            'user' => UserResource::class,
            'client' => ClientResource::class,
            'artwork' => ArtworkResource::class,
            'created_at' => DateResource::class,
            'updated_at' => DateResource::class,
        ];
    }

    /** @var ArtworkResourceInterface */
    private $artwork;

    /** @var UserResource */
    private $user;

    /** @var ClientResource */
    private $client;

    public function getArtwork(): ArtworkResourceInterface
    {
        return $this->artwork;
    }

    public function getUser(): UserResource
    {
        return $this->user;
    }

    public function getClient(): ClientResource
    {
        return $this->client;
    }
}
