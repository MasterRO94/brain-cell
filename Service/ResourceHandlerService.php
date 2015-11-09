<?php

namespace Brain\Cell\Service;

use Brain\Cell\Transfer\AbstractResource;
use Brain\Cell\Transfer\EntityFactory;
use Brain\Cell\TransferEntityInterface;

use Brain\Cell\TransformerDecoderInterface;
use Brain\Cell\TransformerEncoderInterface;

class ResourceHandlerService
{

    /**
     * @var EntityFactory
     */
    protected $factory;

    /**
     * @var TransformerEncoderInterface
     */
    protected $encoder;

    /**
     * @var TransformerDecoderInterface
     */
    protected $decoder;

    /**
     * @param EntityFactory $entityFactory
     * @param TransformerEncoderInterface $encoder
     * @param TransformerDecoderInterface $decoder
     */
    public function __construct(
        EntityFactory $entityFactory,
        TransformerEncoderInterface $encoder,
        TransformerDecoderInterface $decoder
    ) {
        $this->factory = $entityFactory;
        $this->encoder = $encoder;
        $this->decoder = $decoder;
    }

    /**
     * @param TransferEntityInterface $entity
     * @return string
     */
    public function serialise(TransferEntityInterface $entity)
    {
        return $this->encoder->encode($entity);
    }

    /**
     * @param TransferEntityInterface $entity
     * @param array $data
     * @return AbstractResource
     */
    public function deserialise(TransferEntityInterface $entity, array $data)
    {
        return $this->decoder->decode($entity, $data);
    }

    /**
     * @param string $class
     * @param null|int $id
     * @return TransferEntityInterface
     */
    public function create($class, $id = null)
    {
        return $this->factory->create($class, $id);
    }

}
