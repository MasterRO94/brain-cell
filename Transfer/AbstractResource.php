<?php

namespace Brain\Cell\Transfer;

use Brain;

/**
 * An abstract resource.
 */
abstract class AbstractResource implements
    Brain\Cell\TransferEntityInterface,
    Brain\Cell\Transfer\EntityMeta\MetaContainingInterface
{
    use Brain\Cell\Transfer\EntityMeta\MetaContainingTrait;

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

    /** @var mixed $data */
    protected $data;

    /**
     * Store serialised data against the resource
     *
     * Used by encoder and decoder modules to represent serialised state -
     * this is so the encoder can check what's changed since decode
     *
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Retrieve serialised data stored against the resource
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}
