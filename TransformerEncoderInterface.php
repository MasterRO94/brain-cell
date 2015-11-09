<?php

namespace Brain\Cell;

/**
 * A encoder interface.
 *
 * A encoder should always accept serialised view of a given resource and be able to transform that back to its
 * original {@link TransferEntityInterface} object.
 */
interface TransformerEncoderInterface
{

    /**
     * Encode the given {@link TransferEntityInterface} and return the serialised view.
     *
     * @param TransferEntityInterface $entity
     * @return mixed
     */
    public function encode(TransferEntityInterface $entity);

}
