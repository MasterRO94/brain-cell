<?php

namespace Brain\Cell\Transfer\EntityMeta;

use Brain\Cell\Transfer\EntityMeta;

trait MetaContainingTrait
{
    /**
     * @var EntityMeta
     */
    protected $brainMetaResource;

    /**
     * {@inheritdoc}
     *
     * @internal
     */
    public function getResourceMeta()
    {
        return $this->brainMetaResource
            ?: $this->brainMetaResource = new EntityMeta();
    }
}
