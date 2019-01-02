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
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->options[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->options[$offset];
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value): void
    {
        throw new RuntimeException("Can't alter this object after it's created");
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset): void
    {
        throw new RuntimeException("Can't alter this object after it's created");
    }
}
