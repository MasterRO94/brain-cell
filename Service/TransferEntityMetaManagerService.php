<?php

namespace Brain\Cell\Service;

use Brain\Cell\Transfer\EntityMeta;
use Brain\Cell\Transfer\EntityMeta\Link;
use Brain\Cell\Transfer\EntityMeta\MetaContainingInterface;

/**
 * The transfer entity meta manager service.
 *
 * A service that will handle the adding and initialising of meta components against resources.
 */
class TransferEntityMetaManagerService
{

    /**
     * Return the internal {@link EntityMeta} from the given $entity.
     *
     * @param MetaContainingInterface $entity
     * @return EntityMeta
     */
    public function getMeta(MetaContainingInterface $entity)
    {
        //  Note it looks "deprecated" but its marked as "internal".
        return $entity->getResourceMeta();
    }

    /**
     * Check if the given $entity has meta links.
     *
     * @param MetaContainingInterface $entity
     * @return bool
     */
    public function hasMetaLinks(MetaContainingInterface $entity)
    {
        return (boolean) $this->getMeta($entity)->getLinks()->count();
    }

    /**
     * Add a new meta $link to the given $entity.
     *
     * @param MetaContainingInterface $entity
     * @param Link $link
     */
    public function addMetaLink(MetaContainingInterface $entity, Link $link)
    {
        $this->getMeta($entity)->getLinks()->add($link);
    }

}
