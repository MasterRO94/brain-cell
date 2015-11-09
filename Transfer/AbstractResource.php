<?php

namespace Brain\Cell\Transfer;

use Brain;

/**
 * An abstract resource.
 */
abstract class AbstractResource implements
    Brain\Cell\TransferEntityInterface
{

    /**
     * Return all the associations that should be considered single resources.
     *
     * Returns all the associated resources for this resource. The array returned will be formatted with the array key
     * relating to the property against this object and the value is the class name that is expected to be instantiated
     * or supplied.
     *
     * <code>
     * return [
     *  'mouth' => MouthResource::CLASS,
     *  'nose' => NoseResource::CLASS
     * ];
     * </code>
     *
     * @return string[]
     *
     * @internal
     */
    public function getAssociatedResources()
    {
        return [];
    }

    /**
     * Return all the associations that should be considered collections of resources.
     *
     * Returns all the associated collections for this resource. The array returned will be formatted with the array
     * key relating to the property against this object and the value is the class name that is expected to be
     * contained within the collection.
     *
     * <code>
     * return [
     *  'eyes' => EyeResource::CLASS,
     *  'lips' => LipResource::CLASS
     * ];
     * </code>
     *
     * @return string[]
     *
     * @internal
     */
    public function getAssociatedCollections()
    {
        return [];
    }

}
