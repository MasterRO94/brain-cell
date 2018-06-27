<?php

namespace vendor\brain\cell\src\Brain\Cell\EntityResource\Job\ClientWorkflow;

use Brain\Cell\EntityResource\Artifact\ArtifactResource;
use Brain\Cell\EntityResource\Artwork\ArtworkResource;
use Brain\Cell\EntityResource\Interfaces\ResourcePublicIdInterface;
use Brain\Cell\EntityResource\PriceResource;
use Brain\Cell\EntityResource\Product\ProductResource;
use Brain\Cell\EntityResource\ProductionHouseResource;
use Brain\Cell\EntityResource\ShopResource;
use Brain\Cell\EntityResource\ThreeDimensionalResource;
use Brain\Cell\EntityResource\Traits\ResourcePublicIdTrait;
use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\ResourceCollection;

use Symfony\Component\Validator\Constraints as Assert;
use vendor\brain\cell\src\Brain\Cell\EntityResource\Traits\ResourceCreatedUpdatedTrait;

class WorkflowResource extends AbstractResource implements ResourcePublicIdInterface
{
    use ResourcePublicIdTrait;
    use ResourceCreatedUpdatedTrait;
}
