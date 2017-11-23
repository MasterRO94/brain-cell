<?php

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
     *
     * @param EntityResourceFactory $entityFactory
     * @param ArrayEncoder $encoder
     * @param ArrayDecoder $decoder
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
     * @param TransferEntityInterface $entity
     * @param ArrayEncoderSerialisationOptions|null $options
     * @return mixed
     */
    public function serialise(
        TransferEntityInterface $entity,
        ArrayEncoderSerialisationOptions $options = null
    ) {
        return $this->encoder->encode($entity, $options);
    }

    /**
     * Deserialise the given {@link TransferEntityInterface}.
     *
     * @param TransferEntityInterface $entity
     * @param mixed $data
     * @return TransferEntityInterface
     */
    public function deserialise(TransferEntityInterface $entity, $data)
    {
        return $this->decoder->decode($entity, $data);
    }

    /**
     * A shortcut method for the {@link EntityResourceFactory::create()} method.
     *
     * @param string $class
     * @param null|int $id
     * @return TransferEntityInterface
     */
    public function create($class, $id = null)
    {
        return $this->factory->create($class, $id);
    }

}
