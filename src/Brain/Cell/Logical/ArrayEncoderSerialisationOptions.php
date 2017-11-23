<?php

namespace Brain\Cell\Logical;

/**
 * Class ArrayEncoderSerialisationOptions.
 *
 * Options for the ArrayEncoder serialisation process.
 */
class ArrayEncoderSerialisationOptions implements \ArrayAccess
{
    /** @var array */
    private $options;

    public function __construct(array $options = [])
    {
        $this->options = array_merge([
            'serialiseResourceIdInsteadOfWholeBodyIfPossible' => true,
            'preferSerialisingResourceAliasOverId' => true,
        ], $options);
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function offsetExists($offset)
    {
        return isset($this->options[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->options[$offset];
    }

    public function offsetSet($offset, $value)
    {
        throw new \RuntimeException("Can't alter this object after it's created");
    }

    public function offsetUnset($offset)
    {
        throw new \RuntimeException("Can't alter this object after it's created");
    }
}
