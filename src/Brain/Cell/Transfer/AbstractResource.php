<?php

declare(strict_types=1);

namespace Brain\Cell\Transfer;

use Brain\Cell\TransferEntityInterface;

/**
 * An abstract resource.
 */
abstract class AbstractResource implements TransferEntityInterface
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
     * @internal
     *
     * @return string[]
     */
    public function getAssociatedResources(): array
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
     * @internal
     *
     * @return string[]
     */
    public function getAssociatedCollections(): array
    {
        return [];
    }

    /**
     * Return all embedded types that don't have a respective resource class.
     *
     * These should be used for unstructured data (i.e. jsonb on the brain side).
     *
     * @return string[]
     */
    public function getUnstructuredFields(): array
    {
        return [];
    }

    /**
     * Return all properties that should be interpreted as \DateTime.
     *
     * @deprecated
     *
     * @return string[]
     */
    public function getDateTimeProperties(): array
    {
        return [];
    }

    /** @var mixed $brainData */
    protected $brainData;

    /**
     * Store serialised data against the resource.
     *
     * Used by encoder and decoder modules to represent serialised state -
     * this is so the encoder can check what's changed since decode
     *
     * @param mixed $brainData
     */
    public function setBrainData($brainData): void
    {
        $this->brainData = $brainData;
    }

    /**
     * Retrieve serialised data stored against the resource.
     *
     * @return mixed
     */
    public function getBrainData()
    {
        return $this->brainData;
    }
}
