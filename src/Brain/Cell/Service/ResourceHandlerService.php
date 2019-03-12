<?php

declare(strict_types=1);

namespace Brain\Cell\Service;

use Brain\Cell\Logical\ArrayEncoderSerialisationOptions;
use Brain\Cell\Transfer\EntityResourceFactory;
use Brain\Cell\TransferEntityInterface;
use Brain\Cell\Transformer\ArrayDecoder;
use Brain\Cell\Transformer\ArrayEncoder;

/**
 * The resource handler service.
 *
 * The resource handler service will provide a single point of access for the supplied
 * {@link TransformerEncoderInterface} and {@link TransformerDecoderInterface}. For ease of access the
 * {@link EntityResourceFactory} is also available here.
 *
 * @see TransformerEncoderInterface
 * @see TransformerDecoderInterface
 */
class ResourceHandlerService
{
    /**
     * The {@link EntityResourceFactory}.
     *
     * @var EntityResourceFactory
     */
    protected $factory;

    /**
     * The {@link TransformerEncoderInterface}.
     *
     * @var ArrayEncoder
     */
    protected $encoder;

    /**
     * The {@link TransformerDecoderInterface}.
     *
     * @var ArrayDecoder
     */
    protected $decoder;

    /**
     * Construct a new {@link ResourceHandlerService}.
     */
    public function __construct(EntityResourceFactory $entityFactory, ArrayEncoder $encoder, ArrayDecoder $decoder)
    {
        $this->factory = $entityFactory;
        $this->encoder = $encoder;
        $this->decoder = $decoder;
    }

    /**
     * Serialise the given {@link TransferEntityInterface}.
     *
     * @return mixed
     */
    public function serialise(
        TransferEntityInterface $entity,
        ?ArrayEncoderSerialisationOptions $options = null
    ) {
        return $this->encoder->encode($entity, $options);
    }

    /**
     * Deserialise the given {@link TransferEntityInterface}.
     *
     * @param mixed $data
     */
    public function deserialise(TransferEntityInterface $entity, $data): TransferEntityInterface
    {
        return $this->decoder->decode($entity, $data);
    }

    /**
     * A shortcut method for the {@link EntityResourceFactory::create()} method.
     */
    public function create(string $class, ?string $id = null): TransferEntityInterface
    {
        return $this->factory->create($class, $id);
    }
}
