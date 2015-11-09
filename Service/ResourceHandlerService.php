<?php

namespace Brain\Cell\Service;

use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\EntityResourceFactory;
use Brain\Cell\TransferEntityInterface;
use Brain\Cell\TransformerDecoderInterface;
use Brain\Cell\TransformerEncoderInterface;

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
     * @var TransformerEncoderInterface
     */
    protected $encoder;

    /**
     * The {@link TransformerDecoderInterface}.
     *
     * @var TransformerDecoderInterface
     */
    protected $decoder;

    /**
     * Construct a new {@link ResourceHandlerService}.
     *
     * @param EntityResourceFactory $entityFactory
     * @param TransformerEncoderInterface $encoder
     * @param TransformerDecoderInterface $decoder
     */
    public function __construct(
        EntityResourceFactory $entityFactory,
        TransformerEncoderInterface $encoder,
        TransformerDecoderInterface $decoder
    ) {
        $this->factory = $entityFactory;
        $this->encoder = $encoder;
        $this->decoder = $decoder;
    }

    /**
     * Serialise the given {@link TransferEntityInterface}.
     *
     * @param TransferEntityInterface $entity
     * @return mixed
     */
    public function serialise(TransferEntityInterface $entity)
    {
        return $this->encoder->encode($entity);
    }

    /**
     * Deserialise the given {@link TransferEntityInterface}.
     *
     * @param TransferEntityInterface $entity
     * @param mixed $data
     * @return AbstractResource
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
