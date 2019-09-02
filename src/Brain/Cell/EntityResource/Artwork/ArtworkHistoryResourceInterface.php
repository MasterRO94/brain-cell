<?php

declare(strict_types=1);

namespace Brain\Cell\EntityResource\Artwork;

use Brain\Cell\EntityResource\ClientResource;
use Brain\Cell\EntityResource\Prototype\ResourceIdentityInterface;
use Brain\Cell\EntityResource\UserResource;
use Brain\Cell\Prototype\Column\Date\CreatedAtInterface;
use Brain\Cell\Prototype\Column\Date\UpdatedAtInterface;
use Brain\Cell\TransferEntityInterface;

interface ArtworkHistoryResourceInterface extends
    ResourceIdentityInterface,
    CreatedAtInterface,
    UpdatedAtInterface,
    TransferEntityInterface
{
    public function getUser(): UserResource;

    public function getClient(): ClientResource;

    public function getArtwork(): ArtworkResourceInterface;
}
