<?php

namespace Brain\Cell;

interface TransformerDecoderInterface
{

    /**
     * @param TransferEntityInterface $entity
     * @param mixed $data
     * @return TransferEntityInterface
     */
    public function decode(TransferEntityInterface $entity, $data);

}
