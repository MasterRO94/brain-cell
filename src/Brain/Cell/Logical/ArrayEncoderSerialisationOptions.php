<?php

declare(strict_types=1);

namespace Brain\Cell\Logical;

use ArrayAccess;
use RuntimeException;

/**
 * Options for the ArrayEncoder serialisation process.
 */
class ArrayEncoderSerialisationOptions implements ArrayAccess
{
    /** @var mixed[] */
    private $options;

    /**
     * @param mixed[] $options
     */
    public function __construct(array $options = [])
    {
        $this->options = array_merge([
            'serialiseResourceIdInsteadOfWholeBodyIfPossible' => true,
            'preferSerialisingResourceAliasOverId' => true,
        ], $options);
    }

    /**
     * @return mixed[]
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param string $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->options[$offset]);
    }

    /**
     * @param string $offset
     *
     * @return bool
     */
    public function offsetGet($offset)
    {
        return $this->options[$offset];
    }

    /**
     * @param string $offset
     * @param bool $value
     */
    public function offsetSet($offset, $value): void
    {
        throw new RuntimeException("Can't alter this object after it's created");
    }

    /**
     * @param string $offset
     */
    public function offsetUnset($offset): void
    {
        throw new RuntimeException("Can't alter this object after it's created");
    }
}
