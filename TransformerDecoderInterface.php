<?php

namespace Brain\Cell;

/**
 * A decoder interface.
 *
 * A decoder should always accept an instance of {@link TransferEntityInterface} and provide a serialised view of it.
 * This can then be transferred to another service layer than the deserialised back.
 */
interface TransformerDecoderInterface
{

    /**
     * Decode the given $data and populate the given {@link TransferEntityInterface}.
     *
     * @param TransferEntityInterface $entity
     * @param mixed $data
     * @return TransferEntityInterface
     */
    public function decode(TransferEntityInterface $entity, $data);

}
